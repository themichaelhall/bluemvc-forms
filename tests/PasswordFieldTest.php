<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\PasswordField;

/**
 * Test PasswordField class.
 */
class PasswordFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('<input type="password" name="foo" required>', $passwordField->getHtml());
        self::assertSame('<input type="password" name="foo" required>', $passwordField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new PasswordField(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('foo', $passwordField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('', $passwordField->getValue());
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
        $passwordField = new PasswordField('foo');
        $passwordField->setRequired($isRequired);
        $passwordField->setFormValue($value);

        self::assertSame($expectedValue, $passwordField->getValue());
        self::assertSame($expectedIsEmpty, $passwordField->isEmpty());
        self::assertSame($expectedHasError, $passwordField->hasError());
        self::assertSame($expectedError, $passwordField->getError());
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
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue(true);
    }

    /**
     * Test text formatting.
     *
     * @dataProvider textFormattingDataProvider
     *
     * @param string $value              The value
     * @param string $expectedValue      The expected value.
     * @param string $expectedHtmlString The expected html string.
     */
    public function testTextFormatting($value, $expectedValue, $expectedHtmlString)
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue($value);

        self::assertSame($expectedValue, $passwordField->getValue());
        self::assertSame($expectedHtmlString, $passwordField->getHtml());
        self::assertSame($expectedHtmlString, $passwordField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', '', '<input type="password" name="foo" required>'],
            [' ', ' ', '<input type="password" name="foo" required>'],
            ['Foo Bar', 'Foo Bar', '<input type="password" name="foo" required>'],
            ['  Foo  Bar  ', '  Foo  Bar  ', '<input type="password" name="foo" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $passwordField = new PasswordField('<p>');

        self::assertSame('<input type="password" name="&lt;p&gt;" required>', $passwordField->getHtml());
        self::assertSame('<input type="password" name="&lt;p&gt;" required>', $passwordField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $passwordField = new PasswordField('foo');

        self::assertTrue($passwordField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue('bar');

        self::assertFalse($passwordField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $passwordField = new PasswordField('foo');

        self::assertFalse($passwordField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $passwordField = new PasswordField('foo');

        self::assertNull($passwordField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setError('My Error');

        self::assertTrue($passwordField->hasError());
        self::assertSame('My Error', $passwordField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setError(1.2);
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('<input type="password" name="foo" required id="baz" readonly>', $passwordField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $passwordField = new PasswordField('foo');

        self::assertTrue($passwordField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setRequired(false);

        self::assertFalse($passwordField->isRequired());
        self::assertSame('<input type="password" name="foo">', $passwordField->getHtml());
        self::assertSame('<input type="password" name="foo">', $passwordField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setRequired(0);
    }

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue("Foo\0\tBar\r\nBaz");

        self::assertSame('FooBarBaz', $passwordField->getValue());
        self::assertSame('<input type="password" name="foo" required>', $passwordField->__toString());
    }
}
