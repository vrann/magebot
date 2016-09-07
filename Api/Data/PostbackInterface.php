<?php
namespace Vrann\Magebot\Api\Data;

/**
 * Data object representing Sender and Recipient part of the message
 */
interface PostbackInterface
{
    /**
     * @return string
     */
    public function getPayload();

    /**
     * @param string $payload
     * @return $this
     */
    public function setPayload($payload);
}