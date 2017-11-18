<?php

namespace modules\profile\controllers;

use modules\profile\models\auth\LoginForm;
use Yii;
use modules\profile\services\AuthService;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\widgets\ActiveForm;

class AuthController extends Controller
{
    private $authService;

    public function __construct($id, Module $module, AuthService $authService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'recovery', 'accept-token'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Action for authorizate user
     * @return string
     */
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post())) {
            if(Yii::$app->getRequest()->post('ajax') === 'login-form') {
                return $this->asJson(ActiveForm::validate($model));
            }
            if($model->validate() && $this->authService->login(Yii::$app->getUser(), $model)) {
                return $this->goBack();
            }
        }
        return $this->render(
            'login.tpl', [
                'model' => $model,
            ]
        );
    }

    public function actionLogout()
    {
        $this->authService->logout(Yii::$app->getUser());
        return $this->goHome();
    }
}