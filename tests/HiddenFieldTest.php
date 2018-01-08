<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\HiddenField;
use PHPUnit\Framework\TestCase;

/**
 * Test HiddenField class.
 */
class HiddenFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $hiddenField = new HiddenField('foo');

        self::assertSame('<input type="hidden" name="foo">', $hiddenField->getHtml());
        self::assertSame('<input type="hidden" name="foo">', $hiddenField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new HiddenField(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $hiddenField = new HiddenField('foo');

        self::assertSame('foo', $hiddenField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $hiddenField = new HiddenField('foo');

        self::assertSame('', $hiddenField->getValue());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired       True of value is required, false otherwise.
     * @param string      $value            The value.
     * @param string|null $expectedValue    The expected value or null if no value.
     * @param bool        $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool        $expectedHasError The expected value from hasError method.
     * @param string|null $expectedError    The expected error or null if no error.
     */
    public function testSetFormValue($isRequired, $value, $expectedValue, $expectedIsEmpty, $expectedHasError, $expectedError)
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setRequired($isRequired);
        $hiddenField->setFormValue($value);

        self::assertSame($expectedValue, $hiddenField->getValue());
        self::assertSame($expectedIsEmpty, $hiddenField->isEmpty());
        self::assertSame($expectedHasError, $hiddenField->hasError());
        self::assertSame($expectedError, $hiddenField->getError());
    }

    /**
     * Data provider for testSetFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider()
    {
        return [
            [false, '', '', true, false, null],
            [true, '', '', true, true, 'Missing value'],
            [false, ' ', ' ', false, false, null],
            [true, ' ', ' ', false, false, null],
            [false, 'FooBar', 'FooBar', false, false, null],
            [true, 'FooBar', 'FooBar', false, false, null],
            [false, ' Foo  Bar Baz ', ' Foo  Bar Baz ', false, false, null],
            [true, ' Foo  Bar Baz ', ' Foo  Bar Baz ', false, false, null],
        ];
    }

    /**
     * Test setFormValue method with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testSetFormValueWithInvalidValueParameterType()
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setFormValue(true);
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $hiddenField = new HiddenField('<p>');
        $hiddenField->setFormValue('<em>');

        self::assertSame('<input type="hidden" name="&lt;p&gt;" value="&lt;em&gt;">', $hiddenField->getHtml());
        self::assertSame('<input type="hidden" name="&lt;p&gt;" value="&lt;em&gt;">', $hiddenField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $hiddenField = new HiddenField('foo');

        self::assertTrue($hiddenField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setFormValue('bar');

        self::assertFalse($hiddenField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $hiddenField = new HiddenField('foo');

        self::assertFalse($hiddenField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $hiddenField = new HiddenField('foo');

        self::assertNull($hiddenField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setError('My Error');

        self::assertTrue($hiddenField->hasError());
        self::assertSame('My Error', $hiddenField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $hiddenField = new HiddenField('foo', 'bar');

        self::assertSame('bar', $hiddenField->getValue());
        self::assertSame('<input type="hidden" name="foo" value="bar">', $hiddenField->getHtml());
        self::assertSame('<input type="hidden" name="foo" value="bar">', $hiddenField->__toString());
    }

    /**
     * Test constructor with default value with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithDefaultValueWithInvalidParameterType()
    {
        new HiddenField('foo', false);
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $hiddenField = new HiddenField('foo', 'bar');

        self::assertSame('<input type="hidden" name="foo" value="bar" id="baz" readonly>', $hiddenField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $hiddenField = new HiddenField('foo');

        self::assertTrue($hiddenField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $hiddenField = new HiddenField('foo', 'bar');
        $hiddenField->setRequired(false);

        self::assertFalse($hiddenField->isRequired());
        self::assertSame('<input type="hidden" name="foo" value="bar">', $hiddenField->getHtml());
        self::assertSame('<input type="hidden" name="foo" value="bar">', $hiddenField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setRequired(0);
    }

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $hiddenField = new HiddenField('foo');
        $hiddenField->setFormValue("Foo\0\tBar\r\nBaz");

        self::assertSame('FooBarBaz', $hiddenField->getValue());
        self::assertSame('<input type="hidden" name="foo" value="FooBarBaz">', $hiddenField->__toString());
    }
}
