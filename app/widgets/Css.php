<?php

namespace csbans\widgets;

use yii\base\Widget;

class Css extends Widget
{
    public $key = null;
    public $options = [];

    public function init()
    {
        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        $css = ob_get_clean();
        if(preg_match("/^\\s*\\<style\\>(.*)\\<\\/style\\>\\s*$/s", $css, $matches)){
            $css = $matches[1];
        }
        $this->getView()->registerCss($css, $this->options, $this->key);
    }
}