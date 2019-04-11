<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Option;
use PHPUnit\Framework\TestCase;

/**
 * Test Option class.
 */
class OptionTest extends TestCase
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

    /**
     * Test that output is html-encoded..
     */
    public function testOutputIsHtmlEncoded()
    {
        $option = new Option('<h1>foo</h1>', 'Foo & Bar');

        self::assertSame('<option value="&lt;h1&gt;foo&lt;/h1&gt;">Foo &amp; Bar</option>', $option->getHtml());
        self::assertSame('<option value="&lt;h1&gt;foo&lt;/h1&gt;">Foo &amp; Bar</option>', $option->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $option = new Option('foo', 'bar');

        self::assertSame('<option value="foo" class="baz" disabled>bar</option>', $option->getHtml(['class' => 'baz', 'disabled' => true]));
    }

    /**
     * Test isSelected method.
     */
    public function testIsSelected()
    {
        $option = new Option('foo', 'bar');

        self::assertFalse($option->isSelected());
    }

    /**
     * Test setSelected method.
     */
    public function testSetSelected()
    {
        $option = new Option('foo', 'bar');
        $option->setSelected(true);

        self::assertTrue($option->isSelected());
        self::assertSame('<option value="foo" selected>bar</option>', $option->getHtml());
        self::assertSame('<option value="foo" selected>bar</option>', $option->__toString());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $option = new Option('foo', 'bar');

        self::assertNull($option->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $option = new Option('foo', 'bar');
        $option->setCustomData('Baz');

        self::assertSame('Baz', $option->getCustomData());
    }
}
