<?php

namespace ForkCMS\ThemeValidator;

/**
 * This is the access point to the outside world
 * From here, everything you would want to know about a theme can be accessed
 */
class Theme
{
    /** @var ThemeDirectory */
    private $directory;

    /** @var ThemeInfo */
    private $info;

    /**
     * @param ThemeDirectory $directory
     */
    public function __construct(ThemeDirectory $directory)
    {
        $this->directory = $directory;
        $this->info = ThemeInfo::fromDirectory($directory);
    }

    /**
     * @return ThemeDirectory
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @return ThemeInfo
     */
    public function getInfo()
    {
        return $this->info;
    }
}
