<?php

namespace app\models\log;

use Yii;

class Log extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return Yii::$app->params['initial_auth']['application_log'];
    }

    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['created_at'], 'safe'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'ID'),
            'level'         => Yii::t('app', 'Level'),
            'category'      => Yii::t('app', 'Category'),
            'log_time'      => Yii::t('app', 'Log Time'),
            'prefix'        => Yii::t('app', 'Prefix'),
            'message'       => Yii::t('app', 'Message'),
            'created_at'    => Yii::t('app', 'Created At'),
        ];
    }

    public static function find()
    {
        return new LogQuery(get_called_class());
    }
}
