<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class DirectoryDoesNotContainInfoXML extends Exception
{
    public static function withDirectory($directory)
    {
        return new self('The theme directory "' . $directory . '" doesn\'t contain an info.xml file');
    }
}
