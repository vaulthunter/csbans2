<?php

namespace themes\main\widgets;

use Yii;
use modules\profile\models\auth\LoginForm;

class LoginWidget extends \yii\base\Widget
{
    public function run()
    {
        if(Yii::$app->getUser()->getIsGuest()) {
            return $this->getView()->render('@themes/main/widgets/views/login.tpl', [
                'model' => new LoginForm(['remember' => true])
            ]);
        }
    }
}