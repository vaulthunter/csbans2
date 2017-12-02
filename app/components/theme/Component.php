<?php

namespace app\components\theme;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\web\Application;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class Component
 * @package app\components\theme
 *
 * @property $current Theme
 */
class Component extends \yii\base\Component implements BootstrapInterface
{
    const THEME_COOKIE_NAME = 'csb2_theme';

    public $defaultTheme = 'default';

    private $_current;

    private $_basePath;

    private $_name;

    private $_allThemes;

    /**
     * @var Application
     */
    private $app;

    /**
     * @inheritdoc
     * @param Application $app
     */
    public function bootstrap($app)
    {
        $this->app = $app;
        $app->on(Application::EVENT_BEFORE_ACTION, [$this, 'configureTheme']);
    }

    /**
     * Get current theme
     * @return Theme
     * @throws InvalidConfigException
     */
    public function getCurrent()
    {
        if($this->_current === null) {
            $all = $this->getThemes();
            $this->_current = $all[$this->getName()];
        }
        return $this->_current;
    }

    /**
     * Configure yii theme object
     * @throws InvalidConfigException
     */
    public function configureTheme()
    {
        $themePath = $this->getBasePath();
        Yii::setAlias('@theme', $themePath);
        $view = $this->app->getView();
        if($view instanceof \yii\web\View) {
            $this->getCurrent();
            $this->setAssets($view);
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

    /**
     * Get base path to all themes
     * @return string
     */
    public function getBasePath()
    {
        if(!$this->_basePath) {
            $this->_basePath = Yii::getAlias("@themes/{$this->getName()}");
        }
        return $this->_basePath;
    }

    /**
     * Get current theme name
     * @return string
     */
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

    /**
     * Apply theme by name
     * @param $name
     * @throws InvalidConfigException
     */
    public function applyTheme($name)
    {
        if(!$this->isThemeExists($name)) {
            throw new InvalidConfigException("Theme \"{$name}\" does not exists");
        }
        $this->_name = $name;
        $this->setUserTheme($name);

        $this->trigger(ThemeEvent::EVENT_THEME_CHANGED, new ThemeEvent([
            'theme' => $this->getCurrent()
        ]));
    }

    /**
     * Get all themes list
     * @return Theme[]
     * @throws InvalidConfigException
     */
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

    /**
     * Checks if theme exists by name
     * @param string $name Name of theme whom we want to check
     * @return bool false if theme not exists and true if theme exist
     * @throws InvalidConfigException
     */
    public function isThemeExists($name) {
        return in_array($name, $this->getThemes());
    }

    /**
     * Get base url to current theme
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->_bundle->baseUrl;
    }

    /**
     * Get name of user selected theme
     * @return string|null
     */
    private function getUserTheme()
    {
        return Yii::$app->getRequest()->getCookies()->getValue(self::THEME_COOKIE_NAME);
    }

    /**
     * Write name of selected theme to client's storage
     * @param string $name Name of theme whom must be an write to storage
     */
    private function setUserTheme($name)
    {
        $this->app->getResponse()->getCookies()->add(new \yii\web\Cookie([
            'name' => self::THEME_COOKIE_NAME,
            'value' => $name,
            'expire' => time() + (86400 * 30)
        ]));
    }

    /**
     * @var AssetBundle
     */
    private $_bundle;

    /**
     * @param View $view
     * @throws InvalidConfigException
     */
    private function setAssets(View $view)
    {
        $currentTheme = $this->getCurrent();
        $files = FileHelper::findFiles($currentTheme->getFullPath(), [
            'only' => ['*.css', '*.js']
        ]);
        $this->_bundle = Asset::register($view);
        sort($files, SORT_STRING);
        foreach($files as $file) {
            $pathinfo = pathinfo($file);
            if(!empty($pathinfo['extension'])) {
                $this->_bundle->{$pathinfo['extension']}[] = basename($pathinfo['dirname']) . "/{$pathinfo['basename']}";
            }
        }
    }
}
