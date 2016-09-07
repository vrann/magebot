<?php
namespace Vrann\Magebot\Model\Data;
use Vrann\Magebot\Api\Data\MessageInterface;
use Vrann\Magebot\Api\Data\MessagingInterface;
use Vrann\Magebot\Api\Data\PostbackInterface;

class Messaging implements MessagingInterface
{
    private $sender;
    private $recipient;
    private $timestamp;

    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @var PostbackInterface
     */
    private $postback;

    /**
     * @inheritdoc
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @inheritdoc
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @inheritdoc
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPostback($postback)
    {
        $this->postback = $postback;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPostback()
    {
        return $this->postback;
    }
}