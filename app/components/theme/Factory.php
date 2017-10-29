<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.10.2017
 * Time: 2:46
 */

namespace app\components\theme;

use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use Yii;

class Factory
{
    private $themeBasePath;
    
    private $currentThemeName;

    /**
     * @var Theme
     */
    private $theme;

    /**
     * Factory constructor.
     * @param $themeBasePath
     * @param $currentThemeName
     */
    public function __construct($themeBasePath, $currentThemeName)
    {
        $this->themeBasePath = $themeBasePath;
        $this->currentThemeName = $currentThemeName;
    }

    /**
     * @param $themeName
     * @param array $themeData
     * @return Theme
     */
    public function buildTheme($themeName, array $themeData)
    {
        $this->theme = new Theme();
        $this->theme->setDirectory($themeName);
        $this->theme->setName($themeData['name']);
        $this->theme->setFullPath($this->themeBasePath . DIRECTORY_SEPARATOR . $themeName);
        $this->theme->setPreview($this->formatPreview());
        if($themeData['name'] === $this->currentThemeName) {
            $this->theme->setIsCurrent();
        }
        if($themeData['description']) {
            $this->theme->setDescription($themeData['description']);
        }
        if($themeData['description']) {
            $this->theme->setDescription($themeData['description']);
        }
        if($themeData['version']) {
            $this->theme->setVersion($themeData['version']);
        }
        if($themeData['link']) {
            $this->theme->setLink($themeData['link']);
        }
        if(!empty($themeData['authors'])) {
            if(!is_array($themeData['authors'])) {
                throw new InvalidConfigException("Authors must be an array");
            }
            foreach($themeData['authors'] as $authorData) {
                $this->buildAuthor($authorData);
            }
        }
        return $this->theme;
    }

    /**
     * @param array $authorData
     * @return void
     */
    public function buildAuthor(array $authorData)
    {
        $author = new Author();
        $author->setNickName($authorData['nickName']);
        if(!empty($authorData['firstName'])) {
            $author->setFirstName($authorData['firstName']);
        }
        if(!empty($authorData['lastName'])) {
            $author->setLastName($authorData['lastName']);
        }
        if(!empty($authorData['email'])) {
            $author->setLastName($authorData['email']);
        }
        if(!empty($authorData['contacts'])) {
            $author->setContacts($authorData['contacts']);
        }
        if(!empty($authorData['role'])) {
            $author->setRole($authorData['role']);
        }
        $this->theme->addAuthor($author);
    }

    /**
     * Format preview string to url
     * @return null|string
     */
    private function formatPreview()
    {
        $files = FileHelper::findFiles($this->theme->getFullPath(), [
            'filter' => function($path) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if($ext) {
                    return in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']);
                }
                return null;
            }
        ]);
        if(!empty($files[0])) {
            return Yii::$app->getAssetManager()->publish($files[0])[1];
        }
        return null;
    }
}
