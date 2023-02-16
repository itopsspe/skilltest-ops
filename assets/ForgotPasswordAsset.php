<?php

namespace app\assets;

use yii\web\AssetBundle;

class ForgotPasswordAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/layouts/forgot-password.css'
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\MainAsset',
    ];
}