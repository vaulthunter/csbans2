<?php

/**
 * Created by PhpStorm.
 * User: santiago
 * Date: 18.11.17
 * Time: 16:45
 */

namespace csbans\components;

use yii\web\User;

class WebUser extends User
{
    public function getIsAdmin()
    {
        return $this->can('admin');
    }
}