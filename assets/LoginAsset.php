<?php

namespace app\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/layouts/login.css'
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\MainAsset',
    ];
}