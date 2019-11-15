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
    }
}
