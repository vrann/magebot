<?php
namespace Vrann\Magebot\Model\Data;
use Vrann\Magebot\Api\Data\PostbackInterface;

class Postback implements PostbackInterface
{
    /**
     * @var string
     */
    private $payload;

    /**
     * @inheritdoc
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @inheritdoc
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }
}