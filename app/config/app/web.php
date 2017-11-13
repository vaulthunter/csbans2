<?php

return [
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
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:[\w\-]+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
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
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => ['html' => '\yii\helpers\Html'],
                    'filters' => [
                        'jsonEncode' => '\yii\helpers\Json::htmlEncode',
                        'htmlEncode' => '\yii\helpers\Html::encode',
                        'htmlPurify' => '\yii\helpers\HtmlPurifier::process'
                    ]
                ],
            ],
        ],
    ],
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
    ],
];
