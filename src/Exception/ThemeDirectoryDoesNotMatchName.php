<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;
use ForkCMS\ThemeValidator\ThemeDirectory;

final class ThemeDirectoryDoesNotMatchName extends Exception
{
    /**
     * @param ThemeDirectory $directory
     * @param string $name
     *
     * @return self
     */
    public static function withDirectoryAndName(ThemeDirectory $directory, $name)
    {
        return new self(
            'The theme directory "' . $directory->getName() . '" doesn\'t match the theme name "' . $name . '"'
        );
    }
}
