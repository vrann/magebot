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
        "/Do you have books by ([\\w\\s]*)?/" => 'search_catalog_by_author',
        "/What books by (.*) do you have?/" => 'search_catalog_by_author',
        "/I'd like to buy (\\d*) of (.x)/" => 'search_inventory_by_book',
        "/(\\d)+/" => 'quantity'
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