<?php
namespace Vrann\Magebot\Api\Data;

/**
 * Data object representing Message element of the array
 */
interface MessageInterface
{
    /**
     * @return string
     */
    public function getMid();

    /**
     * @return int
     */
    public function getSeq();

    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $mid
     * @return $this
     */
    public function setMid($mid);

    /**
     * @param int $seq
     * @return $this
     */
    public function setSeq($seq);

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text);
}