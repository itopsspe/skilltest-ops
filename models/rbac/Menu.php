<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\models\rbac;

use Yii;
use yii\db\Query;
use app\components\rbac\Configs;

class Menu extends \yii\db\ActiveRecord
{
    public $parent_name;

    public static function tableName()
    {
        return Configs::instance()->menuTable;
    }

    public static function getDb()
    {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_name'], 'in', 'range' => static::find()->select(['name'])->column(), 'message' => 'Menu "{value}" not found.'],
            [['parent', 'route', 'data', 'order'], 'default'],
            [['parent'], 'filterParent', 'when' => function() {
                return !$this->isNewRecord;
            }],
            [['icon'], 'string'],
            [['order'], 'integer'],
            [['route'], 'in', 'range' => static::getSavedRoutes(), 'message' => 'Route "{value}" not found.'],
        ];
    }

    public function filterParent()
    {
        $parent = $this->parent;

        $db = static::getDb();
        
        $query = (new Query)->select(['parent'])->from(static::tableName())->where('[[id]]=:id');

        while ($parent) {
            if ($this->id == $parent) {
                $this->addError('parent_name', 'Loop detected.');
        
                return;
            }
        
            $parent = $query->params([':id' => $parent])->scalar($db);
        }
    }

    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'id'),
            'name'          => Yii::t('app', 'name'),
            'parent'        => Yii::t('app', 'parent'),
            'parent_name'   => Yii::t('app', 'parent name'),
            'route'         => Yii::t('app', 'route'),
            'order'         => Yii::t('app', 'order'),
            'icon'          => Yii::t('app', 'icon'),
            'data'          => Yii::t('app', 'data'),
        ];
    }

    public function getMenuParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

    private static $_routes;

    public static function getSavedRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];

            foreach (Configs::authManager()->getPermissions() as $name => $value) {
                if ($name[0] === '/' && substr($name, -1) != '*') {
                    self::$_routes[] = $name;
                }
            }
        }

        return self::$_routes;
    }

    public static function getMenuSource()
    {
        $tableName = static::tableName();
        
        return (new \yii\db\Query())
                ->select(['m.id', 'm.name', 'm.route', 'm.icon', 'parent_name' => 'p.name'])
                ->from(['m' => $tableName])
                ->leftJoin(['p' => $tableName], '[[m.parent]]=[[p.id]]')
                ->all(static::getDb());
    }
}