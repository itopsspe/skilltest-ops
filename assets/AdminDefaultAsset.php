<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\assets;

use yii\web\AssetBundle;

class AdminDefaultAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/font-awesome-5.11.1/css/all.min.css',
        'vendor/ionicons-2.0.1/css/ionicons.min.css',
        'css/layouts/default/admin.css',
        'css/layouts/default/admin-skin.css',
        'css/layouts/default/drac-utilities.css',
        'css/layouts/default/form.css',
        'css/layouts/default/table.css',
        'css/font.css',
        'css/palette.css'
    ];
    public $js = [
        'js/plugins/ui/jquery.slimscroll.min.js',
        'js/layouts/default/admin.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}