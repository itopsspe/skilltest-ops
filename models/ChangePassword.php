<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ChangePassword extends Model
{
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            [['password'], 'string', 'length' => [6, 15]],
            [['password'], 'match', 'pattern' => '/^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/', 'message' => 'Password must contain at least 8 characters with a mix of letters (uppercase & lowercase), numbers and symbols.'],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app/message', 'Password not match')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password'          => "Password",
            'confirm_password'  => "Confirm Password"
        ];
    }
}