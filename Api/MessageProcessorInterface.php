<?php
namespace Vrann\Magebot\Api;

/**
 * Service interface responsible for processing inbound messages
 */
interface MessageProcessorInterface
{
    /**
     * @param \Vrann\Magebot\Api\Data\MessageTextInterface $messageText
     * @return string
     */
    public function processMessage(\Vrann\Magebot\Api\Data\MessageTextInterface $messageText);
}