<?php

namespace app\models\employees;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string|null $nik
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Employees extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'employees';
    }

    public function rules()
    {
        return [
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['nik'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 13],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nik' => 'NIK',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public static function getLists()
    {
        $employees = (new \yii\db\Query())
            ->select(['nik', 'names', 'phones', 'emails', 'addresses'])
            ->from('employees')
            ->limit(10)
            ->all();

        return $employees;
    }

    public static function getDetail($nik)
    {
        $employees = (new \yii\db\Query())
            ->select(['nik', 'names', 'phones', 'emails', 'addresses'])
            ->from('employees')
            ->where('nik=:nik', [':nik' => $nik])
            ->one();

        return $employees;
    }
}
