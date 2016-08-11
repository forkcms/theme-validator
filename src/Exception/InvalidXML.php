<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class InvalidXML extends Exception
{
    /**
     * @param string $filePath
     * @param Exception $exception
     *
     * @return self
     */
    public static function withFilePath($filePath, Exception $exception = null)
    {
        return new self('File "' . $filePath . '" does not contain valid XML', 0, $exception);
    }
}
