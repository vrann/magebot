<?php
namespace Vrann\Magebot\Model;

/**
 * Classifies user input based on known patterns of conversation
 */
class InputClassifier
{
    /**
     * @var array
     */
    private $patterns = [
        "/Hi/" => 'greeting',
        "/Do you have albums by ([\\w\\s]*)?/" => 'search_catalog_by_artist',
        "/What albums by (.*) do you have?/" => 'search_catalog_by_artist',
        "/I'd like to buy (\\d*) of (.x)/" => 'search_inventory_by_album',
    ];

    /**
     * Match text against known patterns
     *
     * @param String $text
     * @return array|boolean
     */
    public function matchAgainstPatterns($text)
    {
        foreach ($this->patterns as $pattern => $type) {
            $matches = [];
            if (preg_match($pattern, $text, $matches)) {
                return ['type' => $type, 'arguments' => $matches[1]];
            }
        }
        return false;
    }
}