<?php

namespace app\models\setting\maintenance;

use Yii;

class UnderMaintenance extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'under_maintenance';
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'status'], 'integer'],
            [['updated_at'], 'safe'],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'id'),
            'status'        => Yii::t('app', 'status'),
            'updated_at'    => Yii::t('app', 'updated at'),
        ];
    }

    public static function find()
    {
        return new UnderMaintenanceQuery(get_called_class());
    }
}
