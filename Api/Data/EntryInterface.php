<?php
namespace Vrann\Magebot\Api\Data;

/**
 * Data object representing Entry element of the array
 */
interface EntryInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getTime();

    /**
     * @return \Vrann\Magebot\Api\Data\MessagingInterface[]
     */
    public function getMessaging();

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id);

    /**
     * @param string $time
     * @return $this
     */
    public function setTime($time);

    /**
     * @param \Vrann\Magebot\Api\Data\MessagingInterface[] $messaging
     * @return $this
     */
    public function setMessaging($messaging);

    /**
     * Verifies message and tells is it possible to extract text from it
     *
     * @return bool
     */
    public function isDataAvailable();
}