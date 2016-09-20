<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;

final class VersionSegmentIsNegative extends Exception
{
    /**
     * @param int $segment
     *
     * @return self
     */
    public static function withSegment($segment)
    {
        return new self('A segment of the version you provided ("' . $segment . '") is negative');
    }
}
