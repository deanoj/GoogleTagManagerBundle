<?php
/**
 * Created by PhpStorm.
 * User: deanoj
 * Date: 26/08/2014
 * Time: 16:53
 */

namespace Deanoj\GoogleTagManagerBundle\Tests;

use Deanoj\GoogleTagManagerBundle\DataLayer;

class DataLayerTest extends \PHPUnit_Framework_TestCase {

    public function testTrue()
    {
        $this->assertTrue(true);
    }

    public function testAddItem()
    {
        $dataLayer = new DataLayer();

        // add one item
        $dataLayer->addItem('one', 'two');
        $this->assertEquals(1, count($dataLayer->getItems()));

        // add a second item
        $dataLayer->addItem('foo', 'bar');
        $this->assertEquals(2, count($dataLayer->getItems()));

        // overwrite first item
        $dataLayer->addItem('one', 'three');
        $this->assertEquals(2, count($dataLayer->getItems()));
    }

    public function testAddItems()
    {
        $dataLayer = new DataLayer();

        // add an array of items
        $dataLayer->addItems(array('foo'=>'bar', 'one'=>'two'));
        $this->assertEquals(2, count($dataLayer->getItems()));

        // add a second array - replacing one value
        $dataLayer->addItems(array('alpha'=>'beta', 'one'=>'three'));
        $this->assertEquals(3, count($dataLayer->getItems()));
    }
} 