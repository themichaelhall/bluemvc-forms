<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

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
}
