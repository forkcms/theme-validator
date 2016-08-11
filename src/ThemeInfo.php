<?php

namespace ForkCMS\ThemeValidator;

use Exception;
use ForkCMS\ThemeValidator\Exception\InvalidXML;
use ForkCMS\ThemeValidator\Exception\ThemeDirectoryDoesNotMatchName;
use SimpleXMLElement;

/**
 * Here we validate any basic information about the theme
 */
class ThemeInfo
{
    /** @var string */
    private $name;

    /** @var string */
    private $version;

    /** @var ThemeRequirements */
    private $requirements;

    /** @var ThemeThumbnail */
    private $thumbnail;

    /** @var string */
    private $description;

    /** @var ThemeAuthor[] */
    private $authors;

    /**
     * ThemeInfo constructor.
     * @param string $name
     * @param string $version
     * @param ThemeRequirements $requirements
     * @param ThemeThumbnail $thumbnail
     * @param string $description
     * @param ThemeAuthor[] $authors
     */
    public function __construct(
        $name,
        $version,
        ThemeRequirements $requirements,
        ThemeThumbnail $thumbnail,
        $description,
        array $authors
    ) {
        $this->name = $name;
        $this->version = $version;
        $this->requirements = $requirements;
        $this->thumbnail = $thumbnail;
        $this->description = $description;
        $this->authors = $authors;
    }

    /**
     * @param ThemeDirectory $directory
     *
     * @return self
     *
     * @throws InvalidXML
     */
    public static function fromDirectory(ThemeDirectory $directory)
    {
        try {
            $infoXML = new SimpleXMLElement($directory->getInfoXMLPath(), LIBXML_NOCDATA, true);
        } catch (Exception $exception) {
            throw InvalidXML::withFilePath($directory->getInfoXMLPath(), $exception);
        }

        $themeInfo = self::fromXML($infoXML);

        $themeInfo->assertNameMatchesDirectory($directory);

        return $themeInfo;
    }

    /**
     * @param SimpleXMLElement $infoXML
     *
     * @return self
     */
    public static function fromXML(SimpleXMLElement $infoXML)
    {
        $infoXMLConverter = new InfoXMLConverter($infoXML);

        return new self(
            $infoXMLConverter->getName(),
            $infoXMLConverter->getVersion(),
            $infoXMLConverter->getRequirements(),
            $infoXMLConverter->getThumbnail(),
            $infoXMLConverter->getDescription(),
            $infoXMLConverter->getAuthors()
        );
    }

    /**
     * @param ThemeDirectory $directory
     *
     * @throws ThemeDirectoryDoesNotMatchName
     */
    private function assertNameMatchesDirectory(ThemeDirectory $directory)
    {
        if ($directory->getName() !== $this->name) {
            throw ThemeDirectoryDoesNotMatchName::withDirectoryAndName($directory, $this->name);
        }
    }
}
