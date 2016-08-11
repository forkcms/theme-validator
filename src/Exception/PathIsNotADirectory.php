<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class PathIsNotADirectory extends Exception
{
    /**
     * @param string $path
     *
     * @return self
     */
    public static function withPath($path)
    {
        return new self('"' . $path . '" is not a directory');
    }
}
