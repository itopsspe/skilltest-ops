<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\user\User;

class ForgotPassword extends Model
{
    public $email;
    
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'validateEmail'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'email') 
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!User::find()->where(['email' => $this->email])->exists()) {
            return $this->addError($attribute, Yii::t('app/message', 'email not registered'));
        }
    }
}