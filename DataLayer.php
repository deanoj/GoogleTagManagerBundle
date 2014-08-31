<?php
/**
 * Created by PhpStorm.
 * User: deanoj
 * Date: 26/08/2014
 * Time: 16:51
 */

namespace Deanoj\GoogleTagManagerBundle;


class DataLayer {

    private $items = array();

    public function getItems()
    {
        return $this->items;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * Return a JSON encoded string of the items array
     * @return string
     */
    public function getJsonString()
    {
        return json_encode($this->items);
    }

    /**
     * add a new item, if $name already exists, overwrite with the new value
     * @param $name
     * @param $value
     */
    public function addItem($name, $value)
    {
        $this->items[$name] = $value;
    }

    /**
     * merge an array of items into the existing items array
     * @param array $items
     */
    public function addItems(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }
} 