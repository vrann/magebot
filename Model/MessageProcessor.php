<?php
namespace Vrann\Magebot\Model;
use Psr\Log\LoggerInterface;
use Vrann\FbChatBot\Message\Attachment;
use Vrann\FbChatBot\Message\FluentBuilder;
use Vrann\Magebot\Api\MessageSenderInterface;

/**
 * Service interface responsible for processing inbound messages
 */
class MessageProcessor implements \Vrann\Magebot\Api\MessageProcessorInterface
{
    const WANT_TO_BUY_ANSWER_NO = 'WANT_TO_BUY_ANSWER_NO';
    const WANT_TO_BUY_ANSWER_YES = 'WANT_TO_BUY_ANSWER_YES';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var InputClassifier
     */
    private $inputClassifier;

    /**
     * @var MessageSenderInterface
     */
    private $messageSender;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $catalogService;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var \Magento\Catalog\Model\Product\Url
     */
    private $url;

    /**
     * @param LoggerInterface $logger
     * @param InputClassifier $inputClassifier
     * @param MessageSenderInterface $messageSender
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Catalog\Model\Product\Url $url
     */
    public function __construct(
        LoggerInterface $logger,
        InputClassifier $inputClassifier,
        MessageSenderInterface $messageSender,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Catalog\Model\Product\Url $url
    ){
        $this->logger = $logger;
        $this->inputClassifier = $inputClassifier;
        $this->messageSender = $messageSender;
        $this->catalogService = $productRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->url = $url;
    }

    /**
     * @param \Vrann\Magebot\Api\Data\MessageTextInterface $messageText
     * @return string
     */
    public function processMessage(\Vrann\Magebot\Api\Data\MessageTextInterface $messageText)
    {
        echo serialize($messageText);
        /** @var \Vrann\Magebot\Api\Data\MessagingInterface $message */
        $message = $messageText
            ->getEntry()[0]
            ->getMessaging()[0];
        $senderId = $message->getSender()->getId();

        if ($message->getPostback() !== null) {
            $payload = $message->getPostback()->getPayload();
            $this->logger->critical(
                sprintf("Postback reply %s", $message->getPostback()->getPayload())
            );
            $response = null;
            switch ($payload) {
                case self::WANT_TO_BUY_ANSWER_NO:
                    $response = "Do you want to look for another album?";
                    break;
                case self::WANT_TO_BUY_ANSWER_YES:
                    $response = "Great! How many copies would you like?";
                    break;
                default:
                    $response = "I'm sorry, I didn't quite catch that. Can you repeat, please?";
                    break;
            }
            $builder = new FluentBuilder();
            $output = $builder->text()
                ->setText($response)
                ->setRecipientId($senderId)
                ->build();
            $this->messageSender->sendMessage(json_encode($output));
            $this->logger->critical($response);
            return 'OK';
        }

        $text = $message
            ->getMessage()
            ->getText();
        $this->logger->critical(
            $text
        );

        $class = $this->inputClassifier->matchAgainstPatterns($text);
        if (!$class) {
            $response = "Apologies, I didn't quite catch that.  Can you please ask again so I can make sure I've got it right?";
            $builder = new FluentBuilder();
            $output = $builder->text()
                ->setText($response)
                ->setRecipientId($senderId)
                ->build();
            $this->messageSender->sendMessage(json_encode($output));
            $this->logger->critical($response);
            return 'OK';
        }

        switch ($class['type']) {
            case 'greeting':
                $response = "Hi, how may I help you?";
                $builder = new FluentBuilder();
                $output = $builder->text()
                    ->setText($response)
                    ->setRecipientId($senderId)
                    ->build();
                $this->messageSender->sendMessage(json_encode($output));
                $this->logger->critical($response);
                break;
            case 'search_catalog_by_artist':
                $this->searchCriteriaBuilder->addFilters(
                    [
                        $this->filterBuilder
                            ->setField('artist')
                            ->setConditionType('like')
                            ->setValue($class['arguments'])
                            ->create(),
                    ]
                );

                $searchCriteria = $this->searchCriteriaBuilder->create();
                $items = $this->catalogService->getList($searchCriteria)->getItems();
                if (count($items) == 0) {
                    $response = sprintf("Sorry, but we don't have anything by %s. Do you want to try another artist?",
                        $class['arguments']);
                    $builder = new FluentBuilder();
                    $output = $builder->text()
                        ->setText($response)
                        ->setRecipientId($senderId)
                        ->build();
                    $this->messageSender->sendMessage(json_encode($output));
                    $this->logger->critical($response);
                } else {
                    $firstItem = array_shift($items);
                    $response = sprintf("Yes, we do!", $class['arguments']);
                    $builder = new FluentBuilder();
                    $output = $builder->text()
                        ->setText($response)
                        ->setRecipientId($senderId)
                        ->build();
                    $this->messageSender->sendMessage(json_encode($output));
                    $this->logger->critical($response);


                    $builder = new FluentBuilder();
                    $output = $builder->text()
                        ->setText($firstItem->getName())
                        ->setRecipientId($senderId)
                        ->build();
                    $this->messageSender->sendMessage(json_encode($output));
                    $this->logger->critical($response);

                    $builder = new FluentBuilder();
                    $output = $builder->setRecipientId($senderId)
                        ->attachment()
                            ->setType(Attachment::IMAGE)
                            ->setPayload($firstItem->getImageUrl())
                            ->end()
                        ->build();
                    $this->messageSender->sendMessage(json_encode($output));
                    $this->logger->critical($response);

                    $builder = new FluentBuilder();
                    $output = $builder->text()
                        ->setText($firstItem->getDescription())
                        ->setRecipientId($senderId)
                        ->build();
                    $this->messageSender->sendMessage(json_encode($output));
                    $this->logger->critical($response);

                    $builder = new FluentBuilder();
                    $output = $builder->setRecipientId($senderId)
                        ->attachment()
                            ->buttonTemplate()
                                ->setText('Would you like to purchase it?')
                                ->addButton()
                                    ->setTitle('Yes')
                                    ->setPostBack(self::WANT_TO_BUY_ANSWER_YES)
                                    ->end()
                                ->addButton()
                                    ->setTitle('No')
                                    ->setPostBack(self::WANT_TO_BUY_ANSWER_NO)
                                    ->end()
                                ->end()
                            ->end()
                        ->build();
                    $this->messageSender->sendMessage(json_encode($output));
                    $this->logger->critical($response);
                    break;
                }
                return 'OK';
        }
    }
}