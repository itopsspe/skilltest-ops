<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\assets;

use yii\web\AssetBundle;

class AdminLimitlessAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/font-awesome-5.11.1/css/all.min.css',
        'vendor/ionicons-2.0.1/css/ionicons.min.css',
        'vendor/icomoon/styles.min.css',
        'css/layouts/limitless/bootstrap.min.css',
        'css/layouts/limitless/bootstrap-limitless.css',
        'css/layouts/limitless/layout.css',
        'css/layouts/limitless/colors.min.css',
        'css/layouts/limitless/components.min.css',
        'css/layouts/limitless/form.css',
        'css/layouts/limitless/pace.css',
        'css/font.css'
    ];
    public $js = [
        'vendor/bootstrap-4.0.0/js/bootstrap.bundle.min.js',
        'vendor/pace.js/pace.min.js',
        'js/plugins/loaders/blockui.min.js',
        'js/plugins/ui/ripple.min.js',
        'js/layouts/limitless/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}