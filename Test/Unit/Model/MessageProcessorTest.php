<?php
namespace Vrann\Magebot\Test\Unit\Model;

use Vrann\FbChatBot\Message\FluentBuilder;
use Vrann\Magebot\Api\MessageSenderInterfaceRemote;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MessageProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testSendMessage() {
        $messageSender = new MessageSenderInterfaceRemote(
            new \Magento\Framework\MessageQueue\PublisherPool()
        );
        $builder = new FluentBuilder();
        $output = $builder->setRecipientId('test')
            ->attachment()
            ->buttonTemplate()
            ->setText('Do you want to buy it?')
            ->addButton()
            ->setTitle('Yes')
            ->setPostBack('TEST')
            ->end()
            ->addButton()
            ->setTitle('No')
            ->setPostBack('TEST2')
            ->end()
            ->end()
            ->end()
            ->build();
        $messageSender->sendMessage(json_encode($output));
    }
}