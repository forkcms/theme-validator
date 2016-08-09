<?php

namespace ForkCMS\ThemeValidator;

use Exception;
use ForkCMS\ThemeValidator\Exception\DirectoryDoesNotContainInfoXML;
use ForkCMS\ThemeValidator\Exception\InvalidXML;
use ForkCMS\ThemeValidator\Exception\PathIsNotADirectory;
use SimpleXMLElement;

class ThemeValidator
{
    /**
     * @param string $pathToTheme
     */
    public function validate($pathToTheme)
    {
        $pathToTheme = $this->cleanUpPathToTheme($pathToTheme);

        $this->assertPathIsDirectory($pathToTheme);

        // We now know for sure the path is a directory so we can rename the variable.
        $directory = $pathToTheme;

        $this->assertDirectoryHasInfoXML($directory);

        $themeInfo = $this->convertInfoXMLToArray($directory . '/info.xml');
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

    /**
     * @param string $pathToInfoXML
     *
     * @return array
     *
     * @throws InvalidXML
     */
    private function convertInfoXMLToArray($pathToInfoXML)
    {
        try {
            $infoXML = new SimpleXMLElement($pathToInfoXML, LIBXML_NOCDATA, true);

            $infoXMLConverter = new InfoXMLConverter();

            return $infoXMLConverter->toArray($infoXML);

        } catch (Exception $exception) {
            throw InvalidXML::withFilePathAndPreviousException($pathToInfoXML, $exception);
        }
    }
}
