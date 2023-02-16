<?php

namespace app\modules\api;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\api\controllers';

    public function init()
    {
        parent::init();
        
        $this->modules = [
            'bot' => [
                'class' => 'app\modules\api\modules\bot\Module',
            ],
        ];
    }
}
