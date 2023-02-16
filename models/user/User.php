<?php

namespace app\models\user;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property int $id ID
 * @property string $name Name
 * @property string $username Username
 * @property string $email Email
 * @property string $password Password
 * @property string $auth_key Authentication Key
 * @property string $status Status
 * @property string $last_login_datetime Last Login Datetime
 * @property string $created_datetime Created Datetime
 * @property string $updated_datetime Updated Datetime
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BLOCKED = 'blocked';

    const SCENARIO_INSERT_ACCOUNT = 'insert-account';
    const SCENARIO_UPDATE_ACCOUNT = 'update-account';
    const SCENARIO_ACTIVATION = 'activation';
    const SCENARIO_LOGIN_ACCOUNT = 'login-account';
    const SCENARIO_RESET_PASSWORD = 'reset-password';
    const SCENARIO_CHANGE_PASSWORD = 'change-password';

    const BEFORE_CREATE = 'beforeCreate';
    const AFTER_CREATE = 'afterCreate';

    public $current_password;
    public $new_password;
    public $confirm_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return Yii::$app->params['initial_auth']['user'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_login_datetime', 'created_datetime', 'updated_datetime'], 'safe'],
            [['name', 'password_hash', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['new_password', 'confirm_password'], 'match', 'pattern' => '/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/', 'message' => 'Password must contain at least 8 characters with a mix of letters (uppercase & lowercase), numbers and symbols.'],
            [['name', 'username', 'email', 'status', 'new_password', 'confirm_password'], 'required', 'on' => self::SCENARIO_INSERT_ACCOUNT],
            [['name', 'username', 'email', 'status'], 'required', 'on' => self::SCENARIO_INSERT_ACCOUNT],
            [['confirm_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => Yii::t('app/message', 'password not match'), 'on' => self::SCENARIO_INSERT_ACCOUNT],
            [['current_password', 'new_password', 'confirm_password'], 'required', 'on' => self::SCENARIO_CHANGE_PASSWORD],
            [['current_password'], 'validateCurrentPassword', 'on' => self::SCENARIO_CHANGE_PASSWORD],
            [['new_password', 'confirm_new_password'], 'string', 'length' => [6, 15], 'on' => self::SCENARIO_CHANGE_PASSWORD],
            [['confirm_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => Yii::t('app/message', 'password not match'), 'on' => self::SCENARIO_CHANGE_PASSWORD],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                    => Yii::t('app', 'ID'),
            'name'                  => Yii::t('app', 'Name'),
            'username'              => Yii::t('app', 'Username'),
            'email'                 => Yii::t('app', 'Email'),
            'password_hash'         => Yii::t('app', 'Password'),
            'auth_key'              => Yii::t('app', 'Auth Key'),
            'status'                => Yii::t('app', 'Status'),
            'last_login_datetime'   => Yii::t('app', 'Last Login Datetime'),
            'created_datetime'      => Yii::t('app', 'Created Datetime'),
            'updated_datetime'      => Yii::t('app', 'Updated Datetime'),
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_INSERT_ACCOUNT => [
                'id',
                'name',
                'username',
                'email',
                'new_password',
                'confirm_password',
                'password_hash',
                'auth_key',
                'status', 
                'created_datetime'
            ],
            self::SCENARIO_UPDATE_ACCOUNT => [
                'id',
                'name',
                'username',
                'email',
                'new_password',
                'confirm_password',
                'password_hash',
                'auth_key',
                'status'
            ],
            self::SCENARIO_ACTIVATION => ['status'],
            self::SCENARIO_LOGIN_ACCOUNT => ['last_login_datetime'],
            self::SCENARIO_RESET_PASSWORD => ['password_hash'],
            self::SCENARIO_CHANGE_PASSWORD => ['current_password', 'new_password', 'confirm_password', 'password_hash'],
        ];
    }
    
    /**
     * @inheritdoc
     *
     * public function behaviors()
     * {
     *     return [
     *         TimestampBehavior::class,
     *     ];
     * }
     */

    /**
     * Create user
     *
     * @return null|UserModel the saved model or null if saving fails
     *
     * @throws \Exception
     */
    public function create()
    {
        $transaction = $this->getDb()->beginTransaction();

        try {
            $event = $this->getCreateUserEvent($this);

            $this->trigger(self::BEFORE_CREATE, $event);

            $this->setPassword($this->plainPassword);

            $this->generateAuthKey();

            if (!$this->save()) {
                $transaction->rollBack();

                return null;
            }

            $this->trigger(self::AFTER_CREATE, $event);

            $transaction->commit();

            return $this;
        } catch (\Exception $e) {
            $transaction->rollBack();

            Yii::warning($e->getMessage());
            
            throw $e;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user (with active status) by username
     *
     * @param  string $username
     *
     * @return static|null
     *
     */
     
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param $email
     *
     * @return null|static
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);

        $expire = ArrayHelper::getValue(Yii::$app->params, 'user.passwordResetTokenExpire', 3600);
        
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Validates Current Password
     *
     * @param  string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!self::validatePassword($this->current_password)) {
                $this->addError($attribute, Yii::t('app/message', 'incorrect password'));
            }
        }
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @param $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;
    }

    /**
     * Update last login
     */
    public function updateLastLogin()
    {
        $this->updateAttributes(['last_login_datetime' => date('Y-m-d H:i:s')]);
    }

    /**
     * Resets password.
     *
     * @param string $password
     *
     * @return bool
     */
    public function resetPassword($password)
    {
        $this->setPassword($password);
        return $this->save(true, ['password_hash']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
