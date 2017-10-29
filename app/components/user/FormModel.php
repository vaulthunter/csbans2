<?php

namespace app\components\user;

use Yii;

/**
 * Class Model
 * App user
 *
 * @property string $username
 * @property string $email
 * @property string $passwordHash
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class FormModel extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 0;

    public $password;
    public $confirm;

    public static function tableName()
    {
        return '{{%app_user}}';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::class
        ];
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirm'], 'required'],
            ['username', 'unique', 'message' => 'Пользователь с таким логином уже существует'],
            ['email', 'unique', 'message' => 'Пользователь с таким E-mail уже существует'],
            ['email', 'email'],
            [
                'username',
                'match',
                'pattern' => '/^[a-z0-9\.\-_]{4,16}$/',
                'message' => 'Разрешены только буквы латинского алфавита, цифры и знаки . - _'
            ],
            [
                'confirm',
                'compare',
                'compareAttribute' => 'password',
                'message' => 'Пароли не совпадают',
                'when' => function($model) {
                    return !!$model->password;
                }
            ],
        ];
    }

    public function beforeSave($insert)
    {
        $this->passwordHash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return parent::beforeSave($insert);
    }
}