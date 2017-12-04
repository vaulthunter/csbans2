<?php

namespace csbans\components;

use Yii;
use yii\smarty\Extension;
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

class SmartyExtension extends Extension
{
    /**
     * SmartyExtension constructor.
     * @param $viewRenderer
     * @param $smarty
     * @throws \SmartyException
     */
    public function __construct($viewRenderer, $smarty) {
        parent::__construct($viewRenderer, $smarty);
        $this->smarty->registerPlugin('function', 't', [$this, 'functionT']);
        $this->smarty->registerPlugin('function', 'csrfTags', [$this, 'functionCsrfTags']);
        $this->smarty->registerPlugin('function', 'breadcrumbs', [$this, 'functionBreadcrumbs']);
        $this->smarty->registerPlugin('modifier', 'encode', [$this, 'modifierHtmlencode']);
        $this->smarty->registerPlugin('modifier', 'purify', [$this, 'modifierHtmlpurify']);
        $this->smarty->registerPlugin('modifier', 'format', [$this, 'modifierFormat']);
    }

    public function functionBreadcrumbs($params)
    {
        if(!isset($params['links'])) {
            trigger_error('Не переданы ссылки');
        }
        Yii::$app->controller->getView()->params['breadcrumbs'] = $params['links'];
        return;
    }
    
    public function functionCsrfTags()
    {
        return \yii\helpers\Html::csrfMetaTags();
    }

    public function modifierFormat($data, $as)
    {
        $method = 'as' . ucfirst($as);
        return Yii::$app->getFormatter()->{$method}($data);
    }
    
    public function modifierHtmlencode($args)
    {
        return Html::encode($args);
    }
    
    public function modifierHtmlpurify($args)
    {
        return HtmlPurifier::process($args);
    }
    
    public function functionUrl($params, \Smarty_Internal_Template $template)
    {
        if (!isset($params['route'])) {
            trigger_error("path: missing 'route' parameter");
        }
        if($params['route'] === 'home') {
            unset($params['route']);
            $external = (bool)ArrayHelper::remove($params, 'external');
            return Url::to(Yii::$app->homeUrl, $external);
        }
        if($params['route'] === 'current') {
            unset($params['route']);
            return Url::current($params);
        }
        if($params['route'] === 'prevous') {
            unset($params['route']);
            return Url::previous(isset($params['name']) ? $params : null);
        }
        array_unshift($params, $params['route']) ;
        unset($params['route']);
        $external = (bool)ArrayHelper::remove($params, 'external');
        return Url::to($params, $external);
    }
    
    /**
     * @inheritdoc
     */
    public function blockCss($params, $content, $template, &$repeat)
    {
        if ($content !== null) {
            $key = isset($params['key']) ? $params['key'] : null;
            $content = preg_replace('/<style[^>]*>/i', '', $content);
            $content = str_ireplace('</style>', '', $content);
            Yii::$app->getView()->registerCss($content, $params, $key);
        }
    }
    
    /**
     * @inheritdoc
     */
    public function blockJavaScript($params, $content, $template, &$repeat)
    {
        if ($content !== null) {
            $key = isset($params['key']) ? $params['key'] : null;
            $position = isset($params['position']) ? $params['position'] : null;
            $content = preg_replace('/<script[^>]*>/i', '', $content);
            $content = str_ireplace('</script>', '', $content);
            Yii::$app->getView()->registerJs($content,
                                             $this->getViewConstVal($position, View::POS_READY),
                                             $key);
        }
    }
    
    public function functionT($params)
    {
        if(!isset($params['category'])) {
            trigger_error('t: Не передана категория сообщений');
        }
        if(!isset($params['message'])) {
            trigger_error('t: Не передано сообщение');
        }
        $category = $params['category'];
        $message = str_replace(['[[', ']]'], ['{', '}'], $params['message']);
        unset($params['category'], $params['message']);
        if(strpos($category, '/') !== false) {
            $moduleClass = get_class(Yii::$app->controller->module);
            if(method_exists($moduleClass, 't')) {
                return $moduleClass::t($category, $message, $params);
            }
        }
        return \Yii::t($category, $message, $params);
    }
}
