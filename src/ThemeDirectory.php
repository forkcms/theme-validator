<?php

namespace ForkCMS\ThemeValidator;

use ForkCMS\ThemeValidator\Exception\DirectoryDoesNotContainInfoXML;
use ForkCMS\ThemeValidator\Exception\PathIsNotADirectory;

/**
 * This will validate the theme directory and make sure an info.xml file is present
 */
class ThemeDirectory
{
    /** @var string */
    private $path;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $this->cleanUpPathToTheme($path);

        $this->assertPathIsDirectory();
        $this->assertPathContainsInfoXML();
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getInfoXMLPath()
    {
        return $this->path . '/info.xml';
    }

    /**
     * @return string
     */
    public function getName()
    {
        $pathParts = explode('/', $this->path);

        return array_reverse($pathParts)[0];
    }

    /**
     * Makes sure the folder path is th
     * @param string $pathToTheme
     *
     * @return string
     */
    private function cleanUpPathToTheme($pathToTheme)
    {
        $pathToTheme = rtrim($pathToTheme, '/');

        return $pathToTheme;
    }

    /**
     * @throws PathIsNotADirectory
     */
    private function assertPathIsDirectory()
    {
        if (!is_dir($this->path)) {
            throw PathIsNotADirectory::withPath($this->path);
        }
    }

    /**
     * @throws DirectoryDoesNotContainInfoXML
     */
    private function assertPathContainsInfoXML()
    {
        if (!file_exists($this->getInfoXMLPath())) {
            throw DirectoryDoesNotContainInfoXML::withDirectory($this);
        }
    }
}
