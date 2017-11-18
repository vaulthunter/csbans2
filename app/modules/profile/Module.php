<?php

namespace modules\profile;

use yii\filters\AccessControl;
use Yii;

/**
 * main module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'modules\profile\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'except' => [
                    'auth/*',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['profile/*'] = [
            'class'          => \yii\i18n\PhpMessageSource::class,
            'basePath'       => '@modules/profile/messages',
            'forceTranslation' => true,
            'fileMap' => [
                'profile/auth/login' => 'auth/login.php'
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('profile/' . $category, $message, $params, $language);
    }
}
