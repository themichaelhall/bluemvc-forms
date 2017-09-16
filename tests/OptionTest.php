<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Option;

/**
 * Test Option class.
 */
class OptionTest extends \PHPUnit_Framework_TestCase
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
}
