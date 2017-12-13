<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\RadioButtonCollection;

/**
 * Test RadioButtonCollection class.
 */
class RadioButtonCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $select = new RadioButtonCollection('foo');

        self::assertSame('', $select->getHtml());
        self::assertSame('', $select->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new RadioButtonCollection(true);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertSame('foo', $radioButtonCollection->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertSame('', $radioButtonCollection->getValue());
    }

    /**
     * Test isEmpty method.
     */
    public function testIsEmpty()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', 'bar');

        self::assertFalse($radioButtonCollection->isEmpty());
    }

    /**
     * Test constructor with invalid default value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithInvalidDefaultValueParameterType()
    {
        new RadioButtonCollection('foo', 2);
    }
}
