<?php
namespace Vrann\Magebot\Model;
use Psr\Log\LoggerInterface;

/**
 * Service interface responsible for processing inbound messages
 */
class MessageSender implements \Vrann\Magebot\Api\MessageSenderInterface
{
    const TOKEN = 'EAAEg1NXI6wABAGOpnSPZAU9ltfwKZBDj38eu2Sj5aPl7pDWcZCXkPluoK4lshJnHiWKUxBZC4F5kPJPfR2q1DZAw2H9Xr8ODR44g0wVgrd70cCl3WsFo3eE62CiqYTixsmGMvFIutNzeqqEeRNXjLMmjTTZCY8EvOOaScgd7gmuAZDZD';
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param string $message correctly formated message for the Facebook API
     * @return void
     */
    public function sendMessage($message)
    {
        $transport = new \Vrann\FbChatBot\Transport\Http(self::TOKEN, $this->logger);
        $transport->send($message);
    }
}