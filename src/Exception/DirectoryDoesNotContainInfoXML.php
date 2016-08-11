<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;
use ForkCMS\ThemeValidator\ThemeDirectory;

final class DirectoryDoesNotContainInfoXML extends Exception
{
    /**
     * @param ThemeDirectory $directory
     *
     * @return self
     */
    public static function withDirectory(ThemeDirectory $directory)
    {
        return new self('The theme directory "' . $directory->getPath() . '" doesn\'t contain an info.xml file');
    }
}
