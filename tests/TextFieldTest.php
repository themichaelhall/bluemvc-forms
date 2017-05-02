<?php

use BlueMvc\Forms\TextField;

/**
 * Test TextField class.
 */
class TextFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $textField = new TextField('foo');

        self::assertSame('<input type="text" id="form-foo" name="foo">', $textField->getElementHtml());
    }
}
