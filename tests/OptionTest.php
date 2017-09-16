<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Option;

/**
 * Test Option class.
 */
class OptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $option = new Option('foo', 'bar');

        self::assertSame('<option value="foo">bar</option>', $option->getHtml());
        self::assertSame('<option value="foo">bar</option>', $option->__toString());
    }

    /**
     * Test constructor with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithInvalidValueParameterType()
    {
        new Option(false, 'bar');
    }

    /**
     * Test constructor with invalid label parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $label parameter is not a string.
     */
    public function testConstructorWithInvalidLabelParameterType()
    {
        new Option('foo', null);
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $option = new Option('foo', 'bar');

        self::assertSame('foo', $option->getValue());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $option = new Option('foo', 'bar');

        self::assertSame('bar', $option->getLabel());
    }
}
