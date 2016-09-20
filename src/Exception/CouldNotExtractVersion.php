<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class CouldNotExtractVersion extends Exception
{
    /**
     * @param string $versionString
     *
     * @return self
     */
    public static function withVersionString($versionString)
    {
        return new self('Could not extract a version from "' . $versionString . '"');
    }
}
