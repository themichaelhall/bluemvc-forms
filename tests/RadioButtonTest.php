<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
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
     * Test that output is html-encoded.
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

        self::assertSame('<input type="radio" value="foo" class="baz">', $radioButton->getHtml(['class' => 'baz']));
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

    /**
     * Test getCustomData method.
     *
     * @noinspection PhpDeprecationInspection
     */
    public function testGetCustomData()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertNull($radioButton->getCustomData());
    }

    /**
     * Test setCustomData method.
     *
     * @noinspection PhpDeprecationInspection
     */
    public function testSetCustomData()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setCustomData('Baz');

        self::assertSame('Baz', $radioButton->getCustomData());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertFalse($radioButton->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setDisabled(true);

        self::assertTrue($radioButton->isDisabled());
        self::assertSame('<input type="radio" value="foo" disabled>', $radioButton->getHtml());
        self::assertSame('<input type="radio" value="foo" disabled>', $radioButton->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $radioButton = new RadioButton('foo', 'bar');

        self::assertNull($radioButton->getCustomItem('Foo'));
        self::assertNull($radioButton->getCustomItem('Bar'));
        self::assertNull($radioButton->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setCustomItem('Foo', 1234);
        $radioButton->setCustomItem('Bar', true);

        self::assertSame(1234, $radioButton->getCustomItem('Foo'));
        self::assertTrue($radioButton->getCustomItem('Bar'));
        self::assertNull($radioButton->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setCustomItem('Bar', 0.0);
        $radioButton->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($radioButton->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $radioButton = new RadioButton('foo', 'bar');
        $radioButton->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $radioButton->getCustomItem('Foo'));
        self::assertNull($radioButton->getCustomItem('Bar'));
        self::assertFalse($radioButton->getCustomItem('Baz'));
    }
}
