<?php

namespace ForkCMS\ThemeValidator;

use ForkCMS\ThemeValidator\ValueObject\Version;

/**
 * Make sure our environment matches or exceeds the theme's requirements
 */
class ThemeRequirements
{
    /** @var Version */
    private $minimumVersion;

    /**
     * @param Version $minimumVersion
     */
    public function __construct(Version $minimumVersion)
    {
        $this->minimumVersion = $minimumVersion;
    }

    /**
     * @return Version
     */
    public function getMinimumVersion()
    {
        return $this->minimumVersion;
    }
}
