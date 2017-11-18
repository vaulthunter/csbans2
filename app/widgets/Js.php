<?php

namespace csbans\widgets;

use yii\base\Widget;
use yii\web\View;

class Js extends Widget
{
    public $key = null;
    public $position = View::POS_READY;

    public function init()
    {
        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        $js = ob_get_clean();
        if(preg_match("/^\\s*\\<script\\>(.*)\\<\\/script\\>\\s*$/s", $js, $matches)){
            $js = $matches[1];
        }
        $this->getView()->registerJs($js, $this->position, $this->key);
    }
}