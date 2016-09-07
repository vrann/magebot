<?php
namespace Vrann\Magebot\Model\Data;
use Vrann\Magebot\Api\Data\MessageTextInterface;

class MessageText implements MessageTextInterface
{
    private $object;
    private $entry;

    public function getObject()
    {
        return $this->object;
    }

    public function getEntry()
    {
        return $this->entry;
    }

    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    public function setEntry($entry)
    {
        $this->entry = $entry;
        return $this;
    }

    public function isDataAvailable()
    {
        return count($this->getEntry() > 0) && $this->getEntry()[0]->isDataAvailable();
    }
}