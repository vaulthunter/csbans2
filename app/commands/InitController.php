<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.10.2017
 * Time: 13:28
 */

namespace app\commands;

use app\components\user\FormModel;
use yii\console\Controller;
use yii\helpers\Console;

class InitController extends Controller
{
    public function beforeAction($action)
    {
        if (Console::isRunningOnWindows()) {
            `chcp 65001`;
        }
        return parent::beforeAction($action);
    }

    /**
     * Action for add admin
     */
    public function actionAddadmin()
    {
        $this->stdout("Введите данные для добвления нового админа\n");
        $model = new FormModel();
        $model->status = FormModel::STATUS_ACTIVE;
        $this->prompt('Логин:', [
            'required' => true,
            'validator' => function($input, &$error) use ($model) {
                $model->username = $input;
                if(!$model->validate(['username'])) {
                    $error = $model->getFirstError('username');
                    return false;
                }
                return true;
            }
        ]);
        $this->prompt('E-mail:', [
            'required' => true,
            'validator' => function($input, &$error) use ($model) {
                $model->email = $input;
                if(!$model->validate(['email'])) {
                    $error = $model->getFirstError('email');
                    return false;
                }
                return true;
            }
        ]);
        $this->prompt('Пароль:', [
            'required' => true,
            'validator' => function($input, &$error) use ($model) {
                $model->password = $input;
                if(!$model->validate(['password'])) {
                    $error = $model->getFirstError('password');
                    return false;
                }
                return true;
            }
        ]);
        $this->prompt('Подтверждение:', [
            'required' => true,
            'validator' => function($input, &$error) use ($model) {
                $model->confirm = $input;
                if(!$model->validate(['confirm'])) {
                    $error = $model->getFirstError('confirm');
                    return false;
                }
                return true;
            }
        ]);

        if($model->save()) {
            $this->stdout("Новый админ успешно сохранен\n", Console::FG_GREEN);
        } else {
            $this->stderr("При сохранении админа произошла ошибка: \n");
            print_r($model->getErrors());
        }
    }
}