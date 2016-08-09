<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class InvalidXML extends Exception
{
    public static function withFilePathAndPreviousException($filePath, Exception $exception)
    {
        return new self('File "' . $filePath . '" does not contain valid XML', 0, $exception);
    }
}
