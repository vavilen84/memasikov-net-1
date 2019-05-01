<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'fixed',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'mzXxdQH5AgvxiDDhPgmlK4NLENF4VH4n',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache'
        ],
        'errorHandler' => [
            'errorAction' => 'index/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.com',
                'username' => $params['mailer_username'],
                'password' => $params['mailer_password'],
                'port' => 465,
                'encryption' => 'ssl'
            ]
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=127.0.0.1;port=9306;',
            'username' => $params['db_user'],
            'password' => $params['db_password'],
        ],
        'user' => [
            'loginUrl' => '/user/login',
            'identityClass' => 'app\models\db\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . $params['db_host'] . ';dbname=' . $params['db_name'],
            'username' => $params['db_user'],
            'password' => $params['db_password'],
            'charset' => 'utf8',
        ],
        'autocomplete' => [
            'class' => 'app\components\autocomplete\Application',
        ],
        'base' => [
            'class' => 'app\components\Base',
        ],
        'baseComponentData' => [
            'class' => 'app\components\baseComponentData',
        ],
        'console' => [
            'class' => 'app\components\Console',
        ],
        'assetManager' => [
            'bundles' => [
                'all' => [
                    'class' => 'yii\web\AssetBundle',
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'depends' => [
                        'yii\web\YiiAsset',
                        'yii\bootstrap\BootstrapAsset',
                    ]
                ],
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
            ],
        ],
        'rolesControl' => [
            'class' => 'app\components\RolesControl',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/admin/add-image-url' => 'admin/add-image-url',
                '/admin/delete-last' => 'admin/delete-last',

                '/upload-vasya-lozkin' => 'upload/upload-vasya-lozkin',
                '/upload-vk' => 'upload/upload-vk',
                '/upload-new-mem' => 'upload/upload-new-mem',

                '/mem/create/<id:\d+>' => 'mem/create',
                '/mem' => 'mem/index',

                '/author/<author>' => 'index/author',
                '/author/<author>/<uid>' => 'index/author-image',
                '/user-image/<uid:\w+>' => 'index/user-image',
                '/image/<uid:\w+>' => 'index/image',
                '/<tag:\w+>' => 'index/tag',
                '/' => 'index/index',
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '10.0.77.1'],
    ];
}

return $config;
