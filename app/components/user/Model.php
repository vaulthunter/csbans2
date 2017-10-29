<?php

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
class Model extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%app_user}}';
    }
}