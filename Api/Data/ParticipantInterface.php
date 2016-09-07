<?php
namespace Vrann\Magebot\Api\Data;

/**
 * Data object representing Sender and Recipient part of the message
 */
interface ParticipantInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id);
}