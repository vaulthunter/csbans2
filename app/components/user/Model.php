<?php

class Model extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%app_user}}';
    }
}