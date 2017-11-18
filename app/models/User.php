<?php

namespace csbans\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "csbans_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $passwordHash
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;
    const STATUS_WAIT = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'csbans_user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'USER_ID'),
            'username' => Yii::t('user', 'USER_LOGIN'),
            'email' => Yii::t('user', 'USER_EMAIL'),
            'status' => Yii::t('user', 'USER_STATUS'),
            'created_at' => Yii::t('user', 'USER_CREATED'),
            'updated_at' => Yii::t('user', 'USER_UPDATED'),
        ];
    }

    /**
     * Password validate
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->passwordHash);
    }

    /**
     * @return query\User
     */
    public static function find()
    {
        return new query\User(get_called_class());
    }
}
