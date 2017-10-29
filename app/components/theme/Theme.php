<?php

namespace app\components\theme;

class Theme
{
    private $isCurrent = false;

    private $directory;
    private $fullPath;
    private $name;
    private $description;
    private $preview;
    private $version;
    private $link;
    private $authors = [];

    /**
     * @return bool
     */
    public function isCurrent()
    {
        return $this->isCurrent;
    }

    /**
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @return mixed
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * Name of theme
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Theme author information
     * @return Author[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Text description of theme
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Formatted URL address of theme's preview image
     * If preview image not configured on theme, null be returned
     * @return string|null
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Theme's version information
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Theme's link url
     * @return null|string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return Theme
     */
    public function setIsCurrent()
    {
        $this->isCurrent = true;
        return $this;
    }

    /**
     * @param string $name
     * @return Theme
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param array $authors
     * @return Theme
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @param string $description
     * @return Theme
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $preview
     * @return Theme
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
        return $this;
    }

    /**
     * @param string $version
     * @return Theme
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param string $link
     * @return Theme
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @param string $directory
     * @return Theme
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @param mixed $fullPath
     * @return Theme
     */
    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;
        return $this;
    }

    public function addAuthor(Author $author)
    {
        $this->authors[] = $author;
    }
}
