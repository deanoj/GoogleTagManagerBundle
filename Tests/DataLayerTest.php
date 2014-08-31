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
        $this->assertEquals('{"one":"two"}', $dataLayer->getJsonString());

        // add a second item
        $dataLayer->addItem('foo', 'bar');
        $this->assertEquals(2, count($dataLayer->getItems()));
        $this->assertEquals('{"one":"two","foo":"bar"}', $dataLayer->getJsonString());

        // overwrite first item
        $dataLayer->addItem('one', 'three');
        $this->assertEquals(2, count($dataLayer->getItems()));
        $this->assertEquals('{"one":"three","foo":"bar"}', $dataLayer->getJsonString());
    }

    public function testAddItems()
    {
        $dataLayer = new DataLayer();

        // add an array of items
        $dataLayer->addItems(array('foo'=>'bar', 'one'=>'two'));
        $this->assertEquals(2, count($dataLayer->getItems()));
        $this->assertEquals('{"foo":"bar","one":"two"}', $dataLayer->getJsonString());


        // add a second array - replacing one value
        $dataLayer->addItems(array('alpha'=>'beta', 'one'=>'three'));
        $this->assertEquals(3, count($dataLayer->getItems()));
        $this->assertEquals('{"foo":"bar","one":"three","alpha":"beta"}', $dataLayer->getJsonString());

    }

    public function testAddEcommerceTransaction()
    {
        $dataLayer = new DataLayer();

        $product1 = array(
            'sku'       => 'DD44',
            'name'      => 'T-Shirt',
            'category'  => 'Apparel',
            'price'     => 11.99,
            'quantity'   => 1,
        );
        $product2 = array(
            'sku'       => 'AA1243544',
            'name'      => 'Socks',
            'category'  => 'Apparel',
            'price'     => 9.99,
            'quantity'   => 2,
        );
        $transaction = array(
            'transactionId'             => '1234',
            'transactionAffiliation'    => 'Acme Clothing',
            'transactionTotal'          => 38.26,
            'transactionTax'            => 1.29,
            'transactionShipping'       => 5,
            'transactionProducts'       => array(
                $product1, $product2
            ),
        );

        $dataLayer->addItems($transaction);

        $this->assertEquals(6, count($dataLayer->getItems()));

        $expectedJson = '{"transactionId":"1234",'.
            '"transactionAffiliation":"Acme Clothing",'.
            '"transactionTotal":38.26,'.
            '"transactionTax":1.29,'.
            '"transactionShipping":5,'.
            '"transactionProducts":[{"sku":"DD44","name":"T-Shirt","category":"Apparel","price":11.99,"quantity":1},'.
            '{"sku":"AA1243544","name":"Socks","category":"Apparel","price":9.99,"quantity":2}]}';


        $this->assertEquals($expectedJson, $dataLayer->getJsonString());
    }
}