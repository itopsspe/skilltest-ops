<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\modules\admin\modules\rbac\controllers;

use Yii;
use yii\rbac\Item;
use app\components\rbac\PermissionController as PermissionConfig;

class PermissionController extends PermissionConfig
{
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }
    
    public function labels()
    {
        return[
            'Item' => Yii::t('app', 'permission'),
        ];
    }

    public function getType()
    {
        return Item::TYPE_PERMISSION;
    }
}