<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();

        $this->modules = [
            'account' => [
                'class' => 'app\modules\admin\modules\account\Module',
            ],
            'blank' => [
                'class' => 'app\modules\admin\modules\blank\Module',
            ],
            'log' => [
                'class' => 'app\modules\admin\modules\log\Module',
            ],
            'rbac' => [
                'class' => 'app\modules\admin\modules\rbac\Module',
            ],
            'setting' => [
                'class' => 'app\modules\admin\modules\setting\Module',
            ],
            'employees' => [
                'class' => 'app\modules\admin\modules\employees\Module',
            ],
        ];
    }
}
