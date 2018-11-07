<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\RadioButton;
use PHPUnit\Framework\TestCase;

/**
 * Test RadioButton class.
 */
class RadioButtonTest extends TestCase
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

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertSame('', $radioButton->getName());
    }

    /**
     * Test setName method.
     */
    public function testSetName()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setName('baz');

        self::assertSame('baz', $radioButton->getName());
        self::assertSame('<input type="radio" name="baz" value="foo">', $radioButton->getHtml());
        self::assertSame('<input type="radio" name="baz" value="foo">', $radioButton->__toString());
    }

    /**
     * Test isSelected method.
     */
    public function testIsSelected()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertFalse($radioButton->isSelected());
    }

    /**
     * Test setSelected method.
     */
    public function testSetSelected()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setSelected(true);

        self::assertTrue($radioButton->isSelected());
        self::assertSame('<input type="radio" value="foo" checked>', $radioButton->getHtml());
        self::assertSame('<input type="radio" value="foo" checked>', $radioButton->__toString());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setLabel('My label');

        self::assertSame('My label', $radioButton->getLabel());
    }
}
