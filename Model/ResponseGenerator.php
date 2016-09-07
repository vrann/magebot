<?php

class ResponseGenerator
{
    public function __construct()
    {

    }

    public function generateResponse(\Vrann\Magebot\Api\Data\MessageTextInterface $messageText)
    {
        if (!$messageText->isDataAvailable()) {
            return false;
        }
        $text = $messageText
            ->getEntry()[0]
            ->getMessaging()[0]
            ->getMessage()
            ->getText();
    }
}