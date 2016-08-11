<?php

namespace ForkCMS\ThemeValidator;

use ForkCMS\ThemeValidator\Exception\NodeNotFoundInInfoXML;
use ForkCMS\ThemeValidator\Exception\NoThemeNodeInInfoXML;
use SimpleXMLElement;

/**
 * This class receives the entire info.xml file and converts it's content to usable data
 */
class InfoXMLConverter
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

    /** @var ThemeTemplate[] */
    private $templates;

    /**
     * @param SimpleXMLElement $infoXML
     */
    public function __construct(SimpleXMLElement $infoXML)
    {

        $themePath = $infoXML->xpath('/theme');

        $themeNode = $this->getThemeNodeFromPath($themePath);

        $this->name = $this->getNodeValueFromParentNode($themeNode, 'name');
        $this->version = $this->getNodeValueFromParentNode($themeNode, 'version');
        $this->requirements = $this->getRequirementsFromThemeNode($themeNode);
        $this->thumbnail = $this->getThumbnailFromThemeNode($themeNode);
        $this->description = $this->getNodeValueFromParentNode($themeNode, 'description');
        $this->authors = $this->getAuthorsFromThemeNode($themeNode);
        $this->templates = $this->getTemplatesFromThemeNode($themeNode);
    }

    /**
     * @param array $themePath
     *
     * @return SimpleXMLElement
     *
     * @throws NoThemeNodeInInfoXML
     */
    private function getThemeNodeFromPath(array $themePath)
    {
        if (!isset($themePath[0])) {
            throw new NoThemeNodeInInfoXML('No theme node was found in info.xml');
        }

        return $themePath[0];
    }

    /**
     * @param SimpleXMLElement $parentNode
     * @param string $nodeKey
     *
     * @return string
     *
     * @throws NodeNotFoundInInfoXML
     */
    private function getNodeValueFromParentNode(SimpleXMLElement $parentNode, $nodeKey)
    {
        $value = (array) $parentNode->$nodeKey;

        if (!isset($value[0])) {
            throw NodeNotFoundInInfoXML::withNodeKeyAndParentNode($nodeKey, $parentNode);
        }

        return $value[0];
    }

    /**
     * @param SimpleXMLElement $parentNode
     * @param string $nodeKey
     *
     * @return SimpleXMLElement
     *
     * @throws NodeNotFoundInInfoXML
     */
    private function getNodeFromParentNode(SimpleXMLElement $parentNode, $nodeKey)
    {
        $value = $parentNode->$nodeKey;

        if ($value->count() === 0) {
            throw NodeNotFoundInInfoXML::withNodeKeyAndParentNode($nodeKey, $parentNode);
        }

        return $value;
    }

    /**
     * @param SimpleXMLElement $themeNode
     *
     * @return ThemeRequirements
     */
    private function getRequirementsFromThemeNode(SimpleXMLElement $themeNode)
    {
        // @TODO: build actual theme requirements
        return new ThemeRequirements();
    }

    /**
     * @param SimpleXMLElement $themeNode
     *
     * @return ThemeThumbnail
     */
    private function getThumbnailFromThemeNode(SimpleXMLElement $themeNode)
    {
        // @TODO: build actual theme thumbnail
        return new ThemeThumbnail();
    }

    /**
     * @param SimpleXMLElement $themeNode
     *
     * @return ThemeAuthor[]
     */
    private function getAuthorsFromThemeNode(SimpleXMLElement $themeNode)
    {
        // @TODO: build actual theme authors
        return [new ThemeAuthor()];
    }

    /**
     * @param SimpleXMLElement $themeNode
     *
     * @return ThemeTemplate[]
     */
    private function getTemplatesFromThemeNode(SimpleXMLElement $themeNode)
    {
        // @TODO: build actual theme templates
        return [new ThemeTemplate()];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return ThemeRequirements
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @return ThemeThumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return ThemeAuthor[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @return ThemeTemplate[]
     */
    public function getTemplates()
    {
        return $this->templates;
    }
}
