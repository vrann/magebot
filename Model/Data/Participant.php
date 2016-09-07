<?php
namespace Vrann\Magebot\Model\Data;
use Vrann\Magebot\Api\Data\ParticipantInterface;

class Participant implements ParticipantInterface
{
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}