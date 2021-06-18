<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Forms\Tests\Helpers\TestFormElementGroups\TestBasicFormElementGroup;
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
        $formElementGroup = new TestBasicFormElementGroup('foo');

        self::assertSame([
            $formElementGroup->getTextField(),
            $formElementGroup->getCheckBox(),
        ], $formElementGroup->getElements());
        self::assertSame('<input type="text" name="foo-text" required><input type="checkbox" name="foo-checkbox" required>', $formElementGroup->__toString());
    }

    /**
     * Test addElement method.
     */
    public function testAddElement()
    {
        $newElement = new TextField('foo', 'bar');

        $formElementGroup = new TestBasicFormElementGroup('foo');
        $formElementGroup->addElement($newElement);

        self::assertSame([
            $formElementGroup->getTextField(),
            $formElementGroup->getCheckBox(),
            $newElement,
        ], $formElementGroup->getElements());
        self::assertSame('<input type="text" name="foo-text" required><input type="checkbox" name="foo-checkbox" required><input type="text" name="foo" value="bar" required>', $formElementGroup->__toString());
    }

    /**
     * Test addElementGroup method.
     */
    public function testAddElementGroup()
    {
        $newElementGroup = new TestBasicFormElementGroup('bar');

        $formElementGroup = new TestBasicFormElementGroup('foo');
        $formElementGroup->addElementGroup($newElementGroup);

        self::assertSame([
            $formElementGroup->getTextField(),
            $formElementGroup->getCheckBox(),
            $newElementGroup,
        ], $formElementGroup->getElements());
        self::assertSame('<input type="text" name="foo-text" required><input type="checkbox" name="foo-checkbox" required><input type="text" name="bar-text" required><input type="checkbox" name="bar-checkbox" required>', $formElementGroup->__toString());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $formElementGroup = new TestBasicFormElementGroup('foo');

        self::assertNull($formElementGroup->getError());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $formElementGroup = new TestBasicFormElementGroup('foo');

        self::assertFalse($formElementGroup->hasError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $formElementGroup = new TestBasicFormElementGroup('foo');
        $formElementGroup->setError('Foo');

        self::assertSame('Foo', $formElementGroup->getError());
        self::assertTrue($formElementGroup->hasError());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $formElementGroup = new TestBasicFormElementGroup('foo');

        self::assertNull($formElementGroup->getCustomItem('Foo'));
        self::assertNull($formElementGroup->getCustomItem('Bar'));
        self::assertNull($formElementGroup->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $formElementGroup = new TestBasicFormElementGroup('foo');
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
        $formElementGroup = new TestBasicFormElementGroup('foo');
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

        $formElementGroup = new TestBasicFormElementGroup('foo');
        $formElementGroup->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $formElementGroup->getCustomItem('Foo'));
        self::assertNull($formElementGroup->getCustomItem('Bar'));
        self::assertFalse($formElementGroup->getCustomItem('Baz'));
    }
}
