<?php
namespace Vrann\Magebot\Api\Data;
/**
 * Data interface representing message from the Facebook
 *
 *
 * {"object":"page",
 *   "entry":[
 *       {
 *          "id":"287630798278680",
 *          "time":1472477324223,
 *          "messaging":[
 *             {
 *                 "sender":{"id":"1011665925607547"},
 *                 "recipient":{"id":"287630798278680"},
 *                 "timestamp":1472477324176,
 *                 "message":{
 *                     "mid":"mid.1472477324168:bbfddd978b4a70ec71",
 *                     "seq":37,
 *                     "text":"who"}
 *       }]}]}
 */
interface MessageTextInterface
{
    /**
     * @return string
     */
    public function getObject();

    /**
     * @return \Vrann\Magebot\Api\Data\EntryInterface[]
     */
    public function getEntry();

    /**
     * @param string $object
     * @return $this
     */
    public function setObject($object);

    /**
     * @param \Vrann\Magebot\Api\Data\EntryInterface[] $entry
     * @return $this
     */
    public function setEntry($entry);

    /**
     * Verifies message and tells is it possible to extract text from it
     *
     * @return bool
     */
    public function isDataAvailable();
}