<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\models\rbac\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Assignment extends Model
{
    public $id;
    public $name;

    public function rules()
    {
        return [
            [['id', 'name'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('app', 'id'),
            'name'      => Yii::t('app', 'name')
        ];
    }
    
    public function search($params, $class, $nameField)
    {
        $query = $class::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', $nameField, $this->name]);

        return $dataProvider;
    }
}