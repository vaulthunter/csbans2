<?php

namespace csbans\eventsDispatchers;

use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\ViewEvent;
use yii\web\Application;
use yii\web\View;

class ViewEventsDispatcher implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // Listen event after render content
        Event::on(
            View::className(), View::EVENT_AFTER_RENDER,
            function (ViewEvent $event) {
                $this->removeSpacesFromRenderedContent($event);
            }
        );
    }

    /**
     * Remove spaces from generated HTML code
     * @param ViewEvent $event
     */
    private function removeSpacesFromRenderedContent(ViewEvent $event)
    {
        if(YII_ENV_PROD) {
            $event->output = trim(preg_replace('/>\s+</', '><', $event->output));
        }
    }
}