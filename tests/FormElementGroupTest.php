<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\FormElementGroup;
use PHPUnit\Framework\TestCase;

/**
 * Test FormElementGroup class.
 */
class FormElementGroupTest extends TestCase
{
    /**
     * Test getElements method for an empty group.
     */
    public function testGetElementsForEmptyGroup()
    {
        $formElementGroup = new FormElementGroup();

        self::assertSame([], $formElementGroup->getElements());
    }
}
