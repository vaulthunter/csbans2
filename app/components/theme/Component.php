<?php

namespace app\components\theme;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Class Component
 * @package app\components\theme
 *
 * @property $current Theme
 */
class Component extends \yii\base\Component implements \yii\base\BootstrapInterface
{
    const THEME_COOKIE_NAME = 'csb2_theme';

    const EVENT_THEME_CHANGED = 'csb2_theme_changed';

    public $defaultTheme = 'default';

    private $_current;

    private $_basePath;

    private $_name;

    private $_allThemes;

    /**
     * @var \yii\web\Application
     */
    private $app;

    /**
     * @param \yii\web\Application $app
     */
    public function bootstrap($app)
    {
        $this->app = $app;
        $app->on(\yii\web\Application::EVENT_BEFORE_ACTION, [$this, 'configureTheme']);
    }

    /**
     * @return Theme
     */
    public function getCurrent()
    {
        if($this->_current === null) {
            $all = $this->getThemes();
            $this->_current = $all[$this->getName()];
        }
        return $this->_current;
    }

    public function configureTheme()
    {
        $themePath = $this->getBasePath();
        Yii::setAlias('theme', $themePath);
        $view = $this->app->getView();
        if($view instanceof \yii\web\View) {
            $this->getCurrent();
            $view->theme = Yii::createObject([
                'class' => 'yii\base\Theme',
                'pathMap' => [
                    '@app/views' => $themePath,
                    '@app/modules' => $themePath,
                ]
            ]);
        }
        unset($view);
    }

    public function getBasePath()
    {
        if(!$this->_basePath) {
            $this->_basePath = Yii::getAlias("@themes/{$this->getName()}");
        }
        return $this->_basePath;
    }

    public function getName()
    {
        if(!$this->_name) {
            $this->_name = $this->getUserTheme();
            if(!$this->_name) {
                $this->_name = $this->defaultTheme;
            }
        }
        return $this->_name;
    }

    public function applyTheme($name)
    {
        if(!$this->isThemeExists($name)) {
            throw new InvalidConfigException("Theme \"{$name}\" does not exists");
        }
        $this->_name = $name;
        $this->setUserTheme($name);

        $this->trigger(self::EVENT_THEME_CHANGED, new \app\events\ThemeEvent([
            'themeName' => $this->getName()
        ]));
    }

    public function getThemes()
    {
        if($this->_allThemes === null) {
            $this->_allThemes = [];
            $factory = new Factory(Yii::getAlias('@themes'), $this->getName());
            foreach(glob(Yii::getAlias('@themes/*')) as $theme) {
                if(is_dir($theme)) {
                    $name = basename($theme);
                    $configFile = $theme . DIRECTORY_SEPARATOR . 'theme.php';
                    if(!is_file($configFile)) {
                        Yii::warning("{$configFile}: config file not found, Ignore this theme");
                        continue;
                    }
                    $theme = $factory->buildTheme($name, include($configFile));
                    $this->_allThemes[$name] = $theme;
                }
            }
        }
        return $this->_allThemes;
    }

    public function isThemeExists($name) {
        return in_array($name, $this->getThemes());
    }

    private function getUserTheme()
    {
        return Yii::$app->getRequest()->getCookies()->getValue(self::THEME_COOKIE_NAME);
    }

    private function setUserTheme($name)
    {
        $this->app->getResponse()->getCookies()->add(new \yii\web\Cookie([
            'name' => self::THEME_COOKIE_NAME,
            'value' => $name,
            'expire' => time() + (86400 * 30)
        ]));
    }
}
