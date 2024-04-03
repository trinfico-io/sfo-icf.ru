<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9SSSpshNlN8AFwHH-ZUUT8AK1fakCreH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => YII_ENV_DEV,
            'useFileTransport' => false,
            // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                /*
                'host' => 'smtp-pulse.com',
                'username' => 'OGrankova@trinfico.com',
                'password' => 'jaeiad2mHN8YZ',
                */
                'host' => 'smtps.dashasender.ru',
                'username' => 'dkalugin@trinfico.com',
                'password' => '979d6f8f3fea7cdf9b50cb37cb972b75',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
//         'log' => [
//             'traceLevel' => YII_DEBUG ? 3 : 0,
//             'targets' => [
//                 [
//                     'class' => 'yii\log\FileTarget',
//                     'levels' => ['error', 'warning'],
//                 ],
//                 [
//                     'class'     => 'yii\log\EmailTarget',
//                     'mailer'    => 'mailer',
//                     'levels'    => ['error', 'warning'],
//                     'message'   => [
//                         'from'      => [ 'mail@sfo-icf.ru' => 'СФО ИнвестКредит Финанс' ],
//                         'to'        => [ 'sqlalert@trinfico.ru' => 'Служба поддержки' ],
//                         'subject'   => 'Ошибка на сайте СФО ИнвестКредит Финанс',
//                         ],
//                 ],

//             ],
//         ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    //'levels' => ['error', 'warning'],
                    'levels' => ['error'],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                        'from' => ['mail@sfo-icf.ru' => 'СФО ИнвестКредит Финанс'],
                        'to' => ['sqlalert@trinfico.ru' => 'Служба поддержки'],
                        'subject' => 'Ошибки базы данных на сайте СФО ИнвестКредит Финанс',
                    ],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6Ldsm0wUAAAAAPkiE-DGD8zHilNhTfOuP6xkdH8G',
            'secret' => '6Ldsm0wUAAAAAM2mduLpeOoVInnRKBH7D_HwmFxB',
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '10.0.74.3', '195.68.154.162'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '195.68.154.162'],
    ];
}

return $config;
