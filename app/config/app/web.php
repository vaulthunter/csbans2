<?php

$config = [
    'id' => 'csbans2-web',
    'bootstrap' => [
        'theme',
        'csbans\eventsDispatchers\ViewEventsDispatcher'
    ],
    'layout' => 'main.twig',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'sadfsdfsdf',
        ],
        'user' => [
            'class' => \yii\web\User::class,
            'identityClass' => 'csbans\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/profile/auth/login']
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/default/index',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:[\w\-]+>' => '<_m>/<_c>/view',
            ],
        ],
        'theme' => [
            'class' => 'app\components\theme\Component',
            'defaultTheme' => 'default'
        ],
        'view' => [
            'defaultExtension' => 'twig',
            'theme' => [
                'pathMap' => [
                    '@app/modules' => '@app/views',
                ],
            ],
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\smarty\ViewRenderer',
                ],
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    'uses' => [
                        'yii\bootstrap',
                        'csbans\widgets'
                    ],
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => '\yii\helpers\Html',
                        'url' => ['class' => '\yii\helpers\Url']
                    ],
                    'filters' => [
                        'jsonEncode' => '\yii\helpers\Json::htmlEncode',
                        'htmlEncode' => '\yii\helpers\Html::encode',
                        'htmlPurify' => '\yii\helpers\HtmlPurifier::process'
                    ]
                ],
            ],
        ],
    ],
];

if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'web.local.php')) {
    $config = \yii\helpers\ArrayHelper::merge($config, include __DIR__ . DIRECTORY_SEPARATOR . 'web.local.php');
}

return $config;
