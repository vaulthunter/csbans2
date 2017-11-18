<?php

namespace csbans\models\query;

use yii\db\ActiveQuery;

class User extends ActiveQuery
{
    /**
     * Get all users with active status
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(['status' => \csbans\models\User::STATUS_ACTIVE]);
    }

    public function byLogin($login)
    {
        return $this->andWhere(['login' => $login]);
    }
}