<?php

yii::setAlias('rootPath', dirname(dirname(dirname(__DIR__))));
Yii::setAlias('themes', '@rootPath/themes');

return [
    'id' => 'cb2-main',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
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
        'db' => null
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=localhost;dbname=csbans2',
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8mb4',
//            'enableSchemaCache' => true
//        ]
    ],
    'params' => []
];
