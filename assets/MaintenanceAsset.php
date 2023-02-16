<?php

namespace app\assets;

use yii\web\AssetBundle;

class MaintenanceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/bootstrap-4.0.0/css/bootstrap.min.css',
        'vendor/font-awesome-5.11.1/css/all.min.css',
        'css/layouts/maintenance.css',
        'css/font.css',
    ];
    public $js = [
        'vendor/bootstrap-4.0.0/js/bootstrap.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}