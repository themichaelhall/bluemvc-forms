<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Option;
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

        self::assertSame('<select name="foo" required></select>', $select->getHtml());
        self::assertSame('<select name="foo" required></select>', $select->__toString());
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

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $select = new Select('foo');

        self::assertSame('', $select->getValue());
    }

    /**
     * Test addOption method.
     */
    public function testAddOption()
    {
        $select = new Select('foo');
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));

        self::assertSame('<select name="foo" required><option value="1">One</option><option value="2">Two</option></select>', $select->getHtml());
        self::assertSame('<select name="foo" required><option value="1">One</option><option value="2">Two</option></select>', $select->__toString());
    }
}
