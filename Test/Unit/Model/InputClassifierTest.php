<?php
namespace Vrann\Magebot\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Magento\Framework\Config\ConfigOptionsListConstants;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InputClassifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $input
     * @param array $expected
     * @dataProvider conversationPhrasesProvider
     */
    public function testMatchAgainstPatterns($input, $expected) {
        $actual = (new \Vrann\Magebot\Model\InputClassifier())->matchAgainstPatterns($input);
        $this->assertEquals($expected, $actual);
    }

    public function conversationPhrasesProvider()
    {
        return [
            [
                'Do you have books by Marcel Proust?',
                ['type' => 'search_catalog_by_author', 'arguments' => 'Marcel Proust']
            ],
        ];
    }
}