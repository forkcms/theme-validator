<?php

namespace ForkCMS\ForkThemeValidator\Exception;

use Exception;

final class PathIsNotADirectory extends Exception
{
    public static function withPath($path)
    {
        return new self('"' . $path . '" is not a directory');
    }
}
