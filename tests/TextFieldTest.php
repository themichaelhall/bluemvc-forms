<?php

namespace BlueMvc\Forms\Tests;

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

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $textField = new TextField('foo');

        self::assertTrue($textField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $textField = new TextField('foo');
        $textField->setFormValue('bar');

        self::assertFalse($textField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $textField = new TextField('foo');

        self::assertFalse($textField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $textField = new TextField('foo');

        self::assertNull($textField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $textField = new TextField('foo');
        $textField->setError('My Error');

        self::assertTrue($textField->hasError());
        self::assertSame('My Error', $textField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $textField = new TextField('foo');
        $textField->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $textField = new TextField('foo', 'bar');

        self::assertSame('bar', $textField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->__toString());
    }

    /**
     * Test constructor with default value with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithDefaultValueWithInvalidParameterType()
    {
        new TextField('foo', false);
    }
}
