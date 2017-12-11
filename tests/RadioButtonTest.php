<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\RadioButton;

/**
 * Test RadioButton class.
 */
class RadioButtonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertSame('<input type="radio" value="foo">', $radioButton->getHtml());
        self::assertSame('<input type="radio" value="foo">', $radioButton->__toString());
    }

    /**
     * Test constructor with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithInvalidValueParameterType()
    {
        new RadioButton(false, 'bar');
    }

    /**
     * Test constructor with invalid label parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $label parameter is not a string.
     */
    public function testConstructorWithInvalidLabelParameterType()
    {
        new RadioButton('foo', null);
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertSame('foo', $radioButton->getValue());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertSame('bar', $radioButton->getLabel());
    }

    /**
     * Test getLabel method.
     */
    public function testGetDefaultLabel()
    {
        $radioButton = new RadioButton('foo');

        self::assertSame('', $radioButton->getLabel());
    }

    /**
     * Test that output is html-encoded..
     */
    public function testOutputIsHtmlEncoded()
    {
        $radioButton = new RadioButton('<h1>foo</h1>', 'Foo & Bar');

        self::assertSame('<input type="radio" value="&lt;h1&gt;foo&lt;/h1&gt;">', $radioButton->getHtml());
        self::assertSame('<input type="radio" value="&lt;h1&gt;foo&lt;/h1&gt;">', $radioButton->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertSame('<input type="radio" value="foo" class="baz" disabled>', $radioButton->getHtml(['class' => 'baz', 'disabled' => true]));
    }
}
