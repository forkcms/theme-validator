<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class VersionSegmentIsNotAnInteger extends Exception
{
    /**
     * @param string $segment
     *
     * @return self
     */
    public static function withSegment($segment)
    {
        return new self(
            'The version must be in the format [int.int.int], the provided segment "' . $segment . '" is not an int'
        );
    }
}
