<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Select;

/**
 * Test Select class.
 */
class SelectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $select = new Select('foo');

        self::assertSame('<select name="foo" required>', $select->getHtml());
        self::assertSame('<select name="foo" required>', $select->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new Select(true);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $select = new Select('foo');

        self::assertSame('foo', $select->getName());
    }
}
