<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\assets\rbac;

use yii\web\AssetBundle;

class RBACAutoComplete extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/rbac/jquery-ui.css',
    ];

    public $js = [
        'js/rbac/jquery-ui.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
