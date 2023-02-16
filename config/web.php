<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$url = require __DIR__ . '/url.php';
$mailer = require __DIR__ . '/mailer.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'baseUrl' => '',
            'cookieValidationKey' => 'vEcSzQAzHbGEVnHAnvZ_FltT-i4dPJwn',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class'     => 'yii\i18n\PhpMessageSource',
                    'basePath'  => '@app/i18n',
                    'fileMap'   => [
                        'app'           => 'app.php',
                        'app/message'   => 'message.php',
                    ],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\user\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
            'on afterLogin' => function($event) {
                $user = $event->identity;
                $user->updateLastLogin();
            }
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'errorHandler' => [
            'errorAction' => 'error/index'
        ],
        'mailer' => $mailer,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error'],
                    'logTable' => 'application_log'
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $url,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class'     => 'app\modules\api\Module',
            'layout'    => false,
        ],
        'admin' => [
            'class'     => 'app\modules\admin\Module',
            'layout'    => '@app/views/layouts/'.$params['admin_layout'],
        ],
    ],
    'on beforeRequest' => function ($event) {
        $cookies = Yii::$app->request->cookies;
        
        Yii::$app->language = $cookies->getValue('language');
        
        if (!isset(Yii::$app->language)) {
            Yii::$app->language = 'en';
        } else {
            Yii::$app->language = $cookies->getValue('language');
        }
    },
    'as access' => [
        'class' => 'app\components\rbac\AccessControl',
        'allowActions' => [
            'language/*',
            'under-maintenance/*',
            'error/*',
            'home/*',
            'login/*',
            'logout/*',
            'forgot-password/*',
            'change-password/*',
            'api/*',
            'mail/*',
            'admin/*',
            'debug/*',
            'gii/*',
        ]
    ],
    'params' => $params
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
