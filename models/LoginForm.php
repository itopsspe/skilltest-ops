<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\user\User;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = false;
    private $_user = false;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'validateEmail'],
            [['password'], 'validatePassword'],
            [['email'], 'validateActive'],
            [['rememberMe'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'         => Yii::t('app', 'email'),
            'password'      => Yii::t('app', 'password'),
            'rememberMe'    => Yii::t('app', 'remember me'),
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!User::find()->where(['email' => $this->email])->exists()) {
            $this->addError($attribute, Yii::t('app/message', 'email not registered'));
        }
    }
    
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app/message', 'please check your login data'));
            }
        }
    }

    public function validateActive($attribute, $params)
    {
        if (!User::find()->where(['email' => $this->email, 'status' => 'active'])->exists()) {
            $this->addError($attribute, Yii::t('app/message', 'your account is inactive'));
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 : 1800);
        }
        
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}