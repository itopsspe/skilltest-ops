<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\modules\admin\modules\rbac\controllers;

use yii\rbac\Item;
use app\components\rbac\RoleController as RoleConfig;

class RoleController extends RoleConfig
{
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }
    
    public function labels()
    {
        return[
            'Item' => 'Role',
            'Items' => 'Roles',
        ];
    }

    public function getType()
    {
        return Item::TYPE_ROLE;
    }
}