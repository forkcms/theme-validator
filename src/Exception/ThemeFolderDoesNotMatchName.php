<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class ThemeFolderDoesNotMatchName extends Exception
{
    public static function withFolderAndName($folder, $name)
    {
        return new self('The theme folder "' . $folder . '" doesn\'t match the theme name "' . $name . '"');
    }
}
