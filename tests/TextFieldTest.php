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

        self::assertSame('', $textField->getValue());
        self::assertSame('<input type="text" name="foo">', $textField->getHtml());
    }

    /**
     * Test setFormValue method.
     */
    public function testSetFormValue()
    {
        $textField = new TextField('foo');
        $textField->setFormValue('bar');

        self::assertSame('bar', $textField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar">', $textField->getHtml());
    }
}
