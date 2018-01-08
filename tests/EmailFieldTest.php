<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\EmailField;
use DataTypes\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * Test EmailField class.
 */
class EmailFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $emailField = new EmailField('foo');

        self::assertSame('<input type="email" name="foo" required>', $emailField->getHtml());
        self::assertSame('<input type="email" name="foo" required>', $emailField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new EmailField(true);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $emailField = new EmailField('foo');

        self::assertSame('foo', $emailField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $emailField = new EmailField('foo');

        self::assertNull(null, $emailField->getValue());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired        True of value is required, false otherwise.
     * @param string      $value             The value.
     * @param string|null $expectedValue     The expected value or null if no value.
     * @param bool        $expectedIsEmpty   The expected value from isEmpty method.
     * @param bool        $expectedIsInvalid The expected value from isInvalid method.
     * @param bool        $expectedHasError  The expected value from hasError method.
     * @param string|null $expectedError     The expected error or null if no error.
     */
    public function testSetFormValue($isRequired, $value, $expectedValue, $expectedIsEmpty, $expectedIsInvalid, $expectedHasError, $expectedError)
    {
        $emailField = new EmailField('foo');
        $emailField->setRequired($isRequired);
        $emailField->setFormValue($value);

        self::assertSame($expectedValue, $emailField->getValue() !== null ? $emailField->getValue()->__toString() : null);
        self::assertSame($expectedIsEmpty, $emailField->isEmpty());
        self::assertSame($expectedIsInvalid, $emailField->isInvalid());
        self::assertSame($expectedHasError, $emailField->hasError());
        self::assertSame($expectedError, $emailField->getError());
    }

    /**
     * Data provider for testSetFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider()
    {
        return [
            [false, '', null, true, false, false, null],
            [true, '', null, true, false, true, 'Missing value'],
            [false, ' ', null, true, false, false, null],
            [true, ' ', null, true, false, true, 'Missing value'],
            [false, 'FooBar', null, false, true, true, 'Invalid value'],
            [true, 'FooBar', null, false, true, true, 'Invalid value'],
            [false, 'foo.bar@example.com', 'foo.bar@example.com', false, false, false, null],
            [true, 'foo.bar@example.com', 'foo.bar@example.com', false, false, false, null],
            [false, ' foo.bar@example.com ', 'foo.bar@example.com', false, false, false, null],
            [true, ' foo.bar@example.com ', 'foo.bar@example.com', false, false, false, null],
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
        $emailField = new EmailField('foo');
        $emailField->setFormValue(true);
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
        $emailField = new EmailField('foo');
        $emailField->setFormValue($value);

        self::assertSame($expectedValue, $emailField->getValue() !== null ? $emailField->getValue()->__toString() : null);
        self::assertSame($expectedHtmlString, $emailField->getHtml());
        self::assertSame($expectedHtmlString, $emailField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, '<input type="email" name="foo" required>'],
            [' ', null, '<input type="email" name="foo" required>'],
            ['Foo Bar', null, '<input type="email" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', null, '<input type="email" name="foo" value="Foo  Bar" required>'],
            ['foo.bar@example.com', 'foo.bar@example.com', '<input type="email" name="foo" value="foo.bar@example.com" required>'],
            ['  foo.bar@example.com  ', 'foo.bar@example.com', '<input type="email" name="foo" value="foo.bar@example.com" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $emailField = new EmailField('<p>');
        $emailField->setFormValue('<em>');

        self::assertSame('<input type="email" name="&lt;p&gt;" value="&lt;em&gt;" required>', $emailField->getHtml());
        self::assertSame('<input type="email" name="&lt;p&gt;" value="&lt;em&gt;" required>', $emailField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $emailField = new EmailField('foo');

        self::assertTrue($emailField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $emailField = new EmailField('foo', EmailAddress::parse('foo@bar.com'));

        self::assertFalse($emailField->isEmpty());
    }

    /**
     * Test isInvalid method for empty value.
     */
    public function testIsValidForEmptyValue()
    {
        $emailField = new EmailField('foo');

        self::assertFalse($emailField->isInvalid());
    }

    /**
     * Test isInvalid method for non-empty value.
     */
    public function testIsValidForNonEmptyValue()
    {
        $emailField = new EmailField('foo', EmailAddress::parse('foo@bar.com'));

        self::assertFalse($emailField->isInvalid());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $emailField = new EmailField('foo');

        self::assertFalse($emailField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $emailField = new EmailField('foo');

        self::assertNull($emailField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $emailField = new EmailField('foo');
        $emailField->setError('My Error');

        self::assertTrue($emailField->hasError());
        self::assertSame('My Error', $emailField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $emailField = new EmailField('foo');
        $emailField->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $emailField = new EmailField('foo', EmailAddress::parse('foo@bar.example.com'));

        self::assertSame('foo@bar.example.com', $emailField->getValue()->__toString());
        self::assertSame('<input type="email" name="foo" value="foo@bar.example.com" required>', $emailField->getHtml());
        self::assertSame('<input type="email" name="foo" value="foo@bar.example.com" required>', $emailField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $emailField = new EmailField('foo', EmailAddress::parse('foo@bar.example.com'));

        self::assertSame('<input type="email" name="foo" value="foo@bar.example.com" required id="baz" readonly>', $emailField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $emailField = new EmailField('foo');

        self::assertTrue($emailField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $emailField = new EmailField('foo', EmailAddress::parse('foo@bar.example.com'));
        $emailField->setRequired(false);

        self::assertFalse($emailField->isRequired());
        self::assertSame('<input type="email" name="foo" value="foo@bar.example.com">', $emailField->getHtml());
        self::assertSame('<input type="email" name="foo" value="foo@bar.example.com">', $emailField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $emailField = new EmailField('foo');
        $emailField->setRequired(0);
    }

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $emailField = new EmailField('foo');
        $emailField->setFormValue("foo\0\t@\r\nexample.com");

        self::assertSame('foo@example.com', $emailField->getValue()->__toString());
        self::assertSame('<input type="email" name="foo" value="foo@example.com" required>', $emailField->__toString());
    }
}
