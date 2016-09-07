<?php
namespace Vrann\Magebot\Api;

/**
 * Service interface responsible for processing inbound messages
 */
interface MessageSenderInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function sendMessage($message);
}