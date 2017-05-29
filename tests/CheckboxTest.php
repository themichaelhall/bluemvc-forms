<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Checkbox;

/**
 * Test Checkbox class.
 */
class CheckboxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $checkbox = new Checkbox('foo');

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
        new Checkbox(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $checkbox = new Checkbox('foo');

        self::assertSame('foo', $checkbox->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $checkbox = new Checkbox('foo');

        self::assertFalse($checkbox->getValue());
    }

    /**
     * Test setFormValue method.
     */
    public function testSetFormValue()
    {
        $checkbox = new Checkbox('foo');
        $checkbox->setFormValue('on');

        self::assertTrue($checkbox->getValue());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->__toString());
    }

    /**
     * Test setFormValue method with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testSetFormValueWithInvalidValueParameterType()
    {
        $checkbox = new Checkbox('foo');
        $checkbox->setFormValue(true);
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $checkbox = new Checkbox('<p>');

        self::assertSame('<input type="checkbox" name="&lt;p&gt;" required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="&lt;p&gt;" required>', $checkbox->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $checkbox = new Checkbox('foo');

        self::assertTrue($checkbox->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $checkbox = new Checkbox('foo');
        $checkbox->setFormValue('on');

        self::assertFalse($checkbox->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $checkbox = new Checkbox('foo');

        self::assertFalse($checkbox->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $checkbox = new Checkbox('foo');

        self::assertNull($checkbox->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $checkbox = new Checkbox('foo');
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
        $checkbox = new Checkbox('foo');
        $checkbox->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $checkbox = new Checkbox('foo', true);

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
        new Checkbox('foo', 42);
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $checkbox = new Checkbox('foo', true);

        self::assertSame('<input type="checkbox" name="foo" checked required id="baz" readonly>', $checkbox->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $checkbox = new Checkbox('foo');

        self::assertTrue($checkbox->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $checkbox = new Checkbox('foo', true);
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
        $checkbox = new Checkbox('foo');
        $checkbox->setRequired(0);
    }

    /**
     * Test isValid method.
     */
    public function testIsValid()
    {
        $checkbox = new Checkbox('foo');

        self::assertTrue($checkbox->isValid());
    }
}
