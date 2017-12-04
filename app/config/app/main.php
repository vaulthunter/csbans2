<?php

$config = [
    'id' => 'cb2-main',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => [
        'log',
        'csbans\config\app\bootstrap\ConfigureFromConfigFile',
    ],
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'name' => 'CS:Bans',
    'version' => '2.0.0-rc-alfa',
    'aliases' => [
        '@csbans' => '@app',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@themes' => '@csbans/themes',
        '@modules' => '@csbans/modules'
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
        'i18n' => [
            'translations' => [
                'yii*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@yii/messages'
                ],
                'theme*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@theme/messages'
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@csbans/messages'
                ],
                'user*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@csbans/messages'
                ],
            ],
        ],
        'db' => null
    ],
    'params' => []
];

$ds = DIRECTORY_SEPARATOR;
foreach(glob(realpath(__DIR__ . "{$ds}..{$ds}..{$ds}modules") . "{$ds}*") as $moduleDir) {
    $moduleName = basename($moduleDir);
    $config['modules'][$moduleName] = [
        'class' => "modules\\".$moduleName."\Module"
    ];
}

if(file_exists( __DIR__ . DIRECTORY_SEPARATOR . 'main.local.php')) {
    $config = \yii\helpers\ArrayHelper::merge($config, include __DIR__ . DIRECTORY_SEPARATOR . 'main.local.php');
}
return $config;
