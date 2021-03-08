<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Forms\CheckBox;
use BlueMvc\Forms\FormElementGroup;
use BlueMvc\Forms\TextField;
use PHPUnit\Framework\TestCase;

/**
 * Test FormElementGroup class.
 */
class FormElementGroupTest extends TestCase
{
    /**
     * Test getElements method.
     */
    public function testGetElements()
    {
        $formElementGroup = new FormElementGroup();

        self::assertSame([], $formElementGroup->getElements());
        self::assertSame('', $formElementGroup->__toString());
    }

    /**
     * Test addElement method.
     */
    public function testAddElement()
    {
        $element1 = new TextField('foo', 'bar');
        $element2 = new CheckBox('baz');

        $formElementGroup = new FormElementGroup();
        $formElementGroup->addElement($element1);
        $formElementGroup->addElement($element2);

        self::assertSame([$element1, $element2], $formElementGroup->getElements());
        self::assertSame('<input type="text" name="foo" value="bar" required><input type="checkbox" name="baz" required>', $formElementGroup->__toString());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $formElementGroup = new FormElementGroup();

        self::assertNull($formElementGroup->getError());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $formElementGroup = new FormElementGroup();

        self::assertFalse($formElementGroup->hasError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $formElementGroup = new FormElementGroup();
        $formElementGroup->setError('Foo');

        self::assertSame('Foo', $formElementGroup->getError());
        self::assertTrue($formElementGroup->hasError());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $formElementGroup = new FormElementGroup();

        self::assertNull($formElementGroup->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $formElementGroup = new FormElementGroup();
        $formElementGroup->setCustomData(['Foo' => 'Bar']);

        self::assertSame(['Foo' => 'Bar'], $formElementGroup->getCustomData());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $formElementGroup = new FormElementGroup();

        self::assertNull($formElementGroup->getCustomItem('Foo'));
        self::assertNull($formElementGroup->getCustomItem('Bar'));
        self::assertNull($formElementGroup->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $formElementGroup = new FormElementGroup();
        $formElementGroup->setCustomItem('Foo', 1234);
        $formElementGroup->setCustomItem('Bar', true);

        self::assertSame(1234, $formElementGroup->getCustomItem('Foo'));
        self::assertTrue($formElementGroup->getCustomItem('Bar'));
        self::assertNull($formElementGroup->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $formElementGroup = new FormElementGroup();
        $formElementGroup->setCustomItem('Bar', 0.0);
        $formElementGroup->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($formElementGroup->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $formElementGroup = new FormElementGroup();
        $formElementGroup->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $formElementGroup->getCustomItem('Foo'));
        self::assertNull($formElementGroup->getCustomItem('Bar'));
        self::assertFalse($formElementGroup->getCustomItem('Baz'));
    }
}
