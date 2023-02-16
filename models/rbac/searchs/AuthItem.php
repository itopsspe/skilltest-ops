<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\models\rbac\searchs;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\rbac\Item;
use app\components\rbac\Configs;

class AuthItem extends Model
{
    const TYPE_ROUTE = 101;

    public $name;
    public $type;
    public $description;
    public $ruleName;
    public $data;

    public function rules()
    {
        return [
            [['name', 'ruleName', 'description'], 'safe'],
            [['type'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'          => Yii::t('app', 'name'),
            'item_name'     => Yii::t('app', 'item name'),
            'type'          => Yii::t('app', 'type'),
            'description'   => Yii::t('app', 'description'),
            'ruleName'      => Yii::t('app', 'rule name'),
            'data'          => Yii::t('app', 'data'),
        ];
    }

    public function search($params)
    {
        $authManager = Configs::authManager();

        if ($this->type == Item::TYPE_ROLE) {
            $items = $authManager->getRoles();
        } else {
            $items = array_filter($authManager->getPermissions(), function($item) {
                return $this->type == Item::TYPE_PERMISSION xor strncmp($item->name, '/', 1) === 0;
            });
        }
        
        $this->load($params);
        
        if ($this->validate()) {
            $search     = mb_strtolower(trim($this->name));
            $desc       = mb_strtolower(trim($this->description));
            $ruleName   = $this->ruleName;

            foreach ($items as $name => $item) {
                $f = (empty($search) || mb_strpos(mb_strtolower($item->name), $search) !== false) && (empty($desc) || mb_strpos(mb_strtolower($item->description), $desc) !== false) && (empty($ruleName) || $item->ruleName == $ruleName);
                
                if (!$f) {
                    unset($items[$name]);
                }
            }
        }

        return new ArrayDataProvider([
            'allModels' => $items,
        ]);
    }
}