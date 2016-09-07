<?php
namespace Vrann\Magebot\Api\Data;

/**
 * Data object representing Messaging element of the array
 */
interface MessagingInterface
{
    /**
     * @return \Vrann\Magebot\Api\Data\ParticipantInterface
     */
    public function getSender();

    /**
     * @return \Vrann\Magebot\Api\Data\ParticipantInterface
     */
    public function getRecipient();

    /**
     * @return string
     */
    public function getTimestamp();

    /**
     * @return \Vrann\Magebot\Api\Data\MessageInterface
     */
    public function getMessage();

    /**
     * @param \Vrann\Magebot\Api\Data\ParticipantInterface $sender
     * @return $this
     */
    public function setSender($sender);

    /**
     * @param \Vrann\Magebot\Api\Data\ParticipantInterface $recipient
     * @return $this
     */
    public function setRecipient($recipient);

    /**
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp);

    /**
     * @param \Vrann\Magebot\Api\Data\MessageInterface $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * @param \Vrann\Magebot\Api\Data\PostbackInterface $postback
     * @return $this
     */
    public function setPostback($postback);

    /**
     * @return \Vrann\Magebot\Api\Data\PostbackInterface|null
     */
    public function getPostback();
}