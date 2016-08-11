<?php

namespace ForkCMS\ThemeValidator\Exception;

use Exception;
use SimpleXMLElement;

class NodeNotFoundInInfoXML extends Exception
{
    /**
     * @param string $nodeKey
     * @param SimpleXMLElement $parentNode
     *
     * @return self
     */
    public static function withNodeKeyAndParentNode($nodeKey, SimpleXMLElement $parentNode)
    {
        return new self(
            '"' . $parentNode->getName() . '" does not contain "' . $nodeKey . '" in info.xml'
        );
    }
}
