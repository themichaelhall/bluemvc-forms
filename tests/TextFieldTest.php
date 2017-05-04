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

        self::assertSame('<input type="text" name="foo" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" required>', $textField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new TextField(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $textField = new TextField('foo');

        self::assertSame('foo', $textField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $textField = new TextField('foo');

        self::assertSame('', $textField->getValue());
    }

    /**
     * Test setFormValue method.
     */
    public function testSetFormValue()
    {
        $textField = new TextField('foo');
        $textField->setFormValue('bar');

        self::assertSame('bar', $textField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->__toString());
    }

    /**
     * Test that setFormValue method trims the input.
     */
    public function testSetFormValueTrimsInput()
    {
        $textField = new TextField('foo');
        $textField->setFormValue(' bar ');

        self::assertSame('bar', $textField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->__toString());
    }

    /**
     * Test setFormValue method with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testSetFormValueWithInvalidValueParameterType()
    {
        $textField = new TextField('foo');
        $textField->setFormValue(true);
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $textField = new TextField('<Foo>');
        $textField->setFormValue('<Bar>');

        self::assertSame('<input type="text" name="&lt;Foo&gt;" value="&lt;Bar&gt;" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="&lt;Foo&gt;" value="&lt;Bar&gt;" required>', $textField->__toString());
    }
}
