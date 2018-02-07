<?php

namespace BlueMvc\Forms\Tests\Issues;

use BlueMvc\Forms\Option;
use BlueMvc\Forms\Select;
use PHPUnit\Framework\TestCase;

/**
 * Tests issue #1 - Select containing no option with empty value should not have a required attribute.
 */
class Issue0001Test extends TestCase
{
    /**
     * Test required select with one empty option.
     */
    public function testRequiredSelectWithOneEmptyOption()
    {
        $select = new Select('foo');
        $select->addOption(new Option('', 'None'));
        $select->addOption(new Option('1', 'One'));

        self::assertSame('<select name="foo" required><option value="" selected>None</option><option value="1">One</option></select>', $select->__toString());
    }

    /**
     * Test required select with no empty option.
     */
    public function testRequiredSelectWithNoEmptyOption()
    {
        $select = new Select('foo');
        $select->addOption(new Option('0', 'None'));
        $select->addOption(new Option('1', 'One'));

        self::assertSame('<select name="foo"><option value="0">None</option><option value="1">One</option></select>', $select->__toString());
    }
}
