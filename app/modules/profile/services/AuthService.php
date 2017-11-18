<?php

namespace modules\profile\services;

use modules\profile\models\auth\LoginForm;
use yii\web\User;

class AuthService
{
    /**
     * @param User $user
     * @param LoginForm $form
     * @return bool
     */
    public function login(User $user, LoginForm $form)
    {
        return $user->login($form->getUser(), $form->remember ? 3600 * 24 * 30 : 0);
    }

    public function logout(User $user)
    {
        return $user->logout();
    }
}