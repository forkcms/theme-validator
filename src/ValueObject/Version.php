<?php

namespace ForkCMS\ThemeValidator\ValueObject;

use ForkCMS\ThemeValidator\Exception\CouldNotExtractVersion;
use ForkCMS\ThemeValidator\Exception\VersionSegmentIsNegative;
use ForkCMS\ThemeValidator\Exception\VersionSegmentIsNotAnInteger;

class Version
{
    /** @var int */
    private $major;

    /** @var int */
    private $minor;

    /** @var int|null */
    private $patch;

    /**
     * @param int $major
     * @param int $minor
     * @param int|null $patch
     */
    private function __construct($major, $minor, $patch = null)
    {
        $this->setMajor($major);
        $this->setMinor($minor);
        $this->setPatch($patch);
    }

    /**
     * @param int $major
     *
     * @return self
     */
    private function setMajor($major)
    {
        $this->validateVersionNumberSegment($major);

        $this->major = $major;

        return $this;
    }

    /**
     * @param int $minor
     *
     * @return self
     */
    private function setMinor($minor)
    {
        $this->validateVersionNumberSegment($minor);

        $this->minor = $minor;

        return $this;
    }

    /**
     * @param int|null $patch
     *
     * @return self
     */
    private function setPatch($patch)
    {
        // There is a fork tag 3.7 without patch. Because of this we need to make the patch nullable
        if ($patch === null) {
            $this->patch = null;

            return $this;
        };

        $this->validateVersionNumberSegment($patch);

        $this->patch = $patch;

        return $this;
    }

    /**
     * @param int $major
     * @param int $minor
     * @param int|null $patch
     *
     * @return Version
     */
    public static function fromIntegers($major, $minor, $patch = null)
    {
        return new self($major, $minor, $patch);
    }

    /**
     * @param $versionString
     * @return Version
     * @throws CouldNotExtractVersion
     */
    public static function fromString($versionString)
    {
        $matches = [];
        preg_match('/(\d+?)\.(\d+?)(?:\.(\d+?))?/', $versionString, $matches);

        // remove the first entry since that is just the total string.
        unset($matches[0]);

        if (count($matches) !== 3 && count($matches) !== 2) {
            throw CouldNotExtractVersion::withVersionString($versionString);
        }

        return new self((int) $matches[1], (int) $matches[2], isset($matches[3]) ? (int) $matches[3] : null);
    }

    /**
     * @return int
     */
    public function major()
    {
        return $this->major;
    }

    /**
     * @return int
     */
    public function minor()
    {
        return $this->minor;
    }

    /**
     * @return int
     */
    public function patch()
    {
        return $this->patch;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->patch === null) {
            return sprintf('%1$s.%2$s', $this->major, $this->minor);
        }

        return sprintf('%1$s.%2$s.%3$s', $this->major, $this->minor, $this->patch);
    }

    /**
     * @param $versionNumberSegment
     *
     * @throws VersionSegmentIsNegative
     * @throws VersionSegmentIsNotAnInteger
     */
    private function validateVersionNumberSegment($versionNumberSegment)
    {
        if (!is_int($versionNumberSegment)) {
            throw VersionSegmentIsNotAnInteger::withSegment($versionNumberSegment);
        }

        if ($versionNumberSegment < 0) {
            throw VersionSegmentIsNegative::withSegment($versionNumberSegment);
        }
    }

    /**
     * @param Version $versionToCompareTo
     *
     * @return bool
     */
    public function isCompatibleWith(Version $versionToCompareTo)
    {
        if ($versionToCompareTo->major() !== $this->major()) {
            return false;
        }

        if ($versionToCompareTo->minor() > $this->minor()) {
            return false;
        }

        if ($versionToCompareTo->patch() > $this->patch() && $versionToCompareTo->minor() === $this->minor()) {
            return false;
        }

        return true;
    }
}
