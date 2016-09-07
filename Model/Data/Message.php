<?php
namespace Vrann\Magebot\Model\Data;
use Vrann\Magebot\Api\Data\MessageInterface;

class Message implements MessageInterface
{
    private $mid;
    private $seq;
    private $text;

    public function getMid()
    {
        return $this->mid;
    }

    public function getSeq()
    {
        return $this->seq;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setMid($mid)
    {
        $this->mid = $mid;
        return $this;
    }

    public function setSeq($seq)
    {
        $this->seq = $seq;
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
}