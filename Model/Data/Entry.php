<?php
namespace Vrann\Magebot\Model\Data;
use Vrann\Magebot\Api\Data\EntryInterface;

class Entry implements EntryInterface
{
    private $id;
    private $time;
    private $messaging;

    public function getId()
    {
        return $this->id;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getMessaging()
    {
        return $this->messaging;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function setMessaging($messaging)
    {
        $this->messaging = $messaging;
        return $this;
    }

    public function isDataAvailable()
    {
        return count($this->getMessaging()) > 0;
    }
}