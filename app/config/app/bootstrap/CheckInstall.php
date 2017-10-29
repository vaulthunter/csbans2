<?php

namespace app\config\app\bootstrap;


use yii\web\Application;
use yii\base\BootstrapInterface;

class CheckInstall implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if(!$app->has('db')) {
            $app->catchAll = ['/main/default/install'];
        }
    }
}