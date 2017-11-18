<?php

namespace modules\profile\models\auth;

use csbans\models\User;
use modules\profile\Module;
use yii\base\Model;
use yii\web\IdentityInterface;

class LoginForm extends Model
{
    public $login;

    public $password;

    public $remember;

    /**
     * @var \csbans\models\User
     */
    private $user = false;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['login', 'required', 'message' => Module::t('auth/login', 'LOGIN_LOGIN_REQUIRED_ERROR')],
            ['password', 'required', 'message' => Module::t('auth/login', 'LOGIN_PASSWORD_REQUIRED_ERROR')],
            ['password', 'validatePassword'],
            ['remember', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => Module::t('auth/login', 'LOGIN_LABEL_LOGIN'),
            'password' => Module::t('auth/login', 'LOGIN_LABEL_PASSWORD'),
            'remember' => Module::t('auth/login', 'LOGIN_LABEL_REMEMBER'),
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Module::t('auth/login', 'LOGIN_WRONG_USER_OR_PASSWORD'));
            }
        }
    }

    /**
     * @return IdentityInterface|User|null
     */
    public function getUser()
    {
        if($this->user === false) {
            $this->user = User::find()->byLogin($this->login)->active()->one();
        }
        return $this->user;
    }
}
