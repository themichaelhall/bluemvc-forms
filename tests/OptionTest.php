<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
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
     * Test that output is html-encoded.
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

        self::assertSame('<option value="foo" class="baz" id="foo-bar">bar</option>', $option->getHtml(['class' => 'baz', 'id' => 'foo-bar']));
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
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $option = new Option('foo', 'bar');

        self::assertFalse($option->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $option = new Option('foo', 'bar');
        $option->setDisabled(true);

        self::assertTrue($option->isDisabled());
        self::assertSame('<option value="foo" disabled>bar</option>', $option->getHtml());
        self::assertSame('<option value="foo" disabled>bar</option>', $option->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $option = new Option('foo', 'bar');

        self::assertNull($option->getCustomItem('Foo'));
        self::assertNull($option->getCustomItem('Bar'));
        self::assertNull($option->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $option = new Option('foo', 'bar');
        $option->setCustomItem('Foo', 1234);
        $option->setCustomItem('Bar', true);

        self::assertSame(1234, $option->getCustomItem('Foo'));
        self::assertTrue($option->getCustomItem('Bar'));
        self::assertNull($option->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $option = new Option('foo', 'bar');
        $option->setCustomItem('Bar', 0.0);
        $option->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($option->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $option = new Option('foo', 'bar');
        $option->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $option->getCustomItem('Foo'));
        self::assertNull($option->getCustomItem('Bar'));
        self::assertFalse($option->getCustomItem('Baz'));
    }
}
