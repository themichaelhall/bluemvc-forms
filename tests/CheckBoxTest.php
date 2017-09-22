<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\CheckBox;

/**
 * Test CheckBox class.
 */
class CheckBoxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $checkbox = new CheckBox('foo');

        self::assertSame('<input type="checkbox" name="foo" required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" required>', $checkbox->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new CheckBox(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $checkbox = new CheckBox('foo');

        self::assertSame('foo', $checkbox->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $checkbox = new CheckBox('foo');

        self::assertFalse($checkbox->getValue());
    }

    /**
     * Test setFormValue method.
     */
    public function testSetFormValue()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setFormValue('on');

        self::assertTrue($checkbox->getValue());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->__toString());
        self::assertFalse($checkbox->hasError());
    }

    /**
     * Test setFormValue method with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testSetFormValueWithInvalidValueParameterType()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setFormValue(true);
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $checkbox = new CheckBox('<p>');

        self::assertSame('<input type="checkbox" name="&lt;p&gt;" required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="&lt;p&gt;" required>', $checkbox->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $checkbox = new CheckBox('foo');

        self::assertTrue($checkbox->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setFormValue('on');

        self::assertFalse($checkbox->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $checkbox = new CheckBox('foo');

        self::assertFalse($checkbox->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $checkbox = new CheckBox('foo');

        self::assertNull($checkbox->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setError('My Error');

        self::assertTrue($checkbox->hasError());
        self::assertSame('My Error', $checkbox->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $checkbox = new CheckBox('foo', true);

        self::assertTrue($checkbox->getValue());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->__toString());
    }

    /**
     * Test constructor with default value with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a boolean.
     */
    public function testConstructorWithDefaultValueWithInvalidParameterType()
    {
        new CheckBox('foo', 42);
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $checkbox = new CheckBox('foo', true);

        self::assertSame('<input type="checkbox" name="foo" checked required id="baz" readonly>', $checkbox->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $checkbox = new CheckBox('foo');

        self::assertTrue($checkbox->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $checkbox = new CheckBox('foo', true);
        $checkbox->setRequired(false);

        self::assertFalse($checkbox->isRequired());
        self::assertSame('<input type="checkbox" name="foo" checked>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" checked>', $checkbox->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setRequired(0);
    }
}
