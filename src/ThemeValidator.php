<?php

namespace ForkCMS\ThemeValidator;

use ForkCMS\ThemeValidator\Exception\DirectoryDoesNotContainInfoXML;
use ForkCMS\ThemeValidator\Exception\PathIsNotADirectory;

class ThemeValidator
{
    public function validate($pathToTheme)
    {
        $pathToTheme = $this->cleanUpPathToTheme($pathToTheme);

        $this->assertPathIsDirectory($pathToTheme);

        // We now know for sure the path is a directory so we can rename the variable.
        $directory = $pathToTheme;

        $this->assertDirectoryHasInfoXML($directory);
    }

    /**
     * Makes sure the folder path is th
     * @param string $pathToTheme
     *
     * @return string
     */
    private function cleanUpPathToTheme($pathToTheme)
    {
        $pathToTheme = trim($pathToTheme, '/');

        return $pathToTheme;
    }

    /**
     * @param string $pathToTheme
     *
     * @throws PathIsNotADirectory
     */
    private function assertPathIsDirectory($pathToTheme)
    {
        if (!is_dir($pathToTheme)) {
            throw PathIsNotADirectory::withPath($pathToTheme);
        }
    }

    /**
     * @param string $directory
     *
     * @throws DirectoryDoesNotContainInfoXML
     */
    private function assertDirectoryHasInfoXML($directory)
    {
        if (!file_exists($directory . '/info.xml')) {
            throw DirectoryDoesNotContainInfoXML::withDirectory($directory);
        }
    }
}
