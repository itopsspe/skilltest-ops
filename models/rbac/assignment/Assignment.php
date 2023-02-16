<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\models\rbac\assignment;

use Yii;

class Assignment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return Yii::$app->params['initial_auth']['assignment'];
    }

    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'item_name'     => Yii::t('app', 'item name'),
            'user_id'       => Yii::t('app', 'user id'),
            'created_at'    => Yii::t('app', 'created at'),
        ];
    }

    public static function find()
    {
        return new AssignmentQuery(get_called_class());
    }
}