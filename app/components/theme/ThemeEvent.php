<?php

namespace app\components\theme;

class ThemeEvent extends \yii\base\Event
{
    const EVENT_THEME_CHANGED = 'csb2_theme_changed';

    /**
     * @var Theme
     */
    public $theme;
}