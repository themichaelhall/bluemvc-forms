<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\DateTimeField;
use PHPUnit\Framework\TestCase;

/**
 * Test DateTimeField class.
 */
class DateTimeFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertSame('<input type="datetime-local" name="foo" required>', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" required>', $dateTimeField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new DateTimeField(null);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertSame('foo', $dateTimeField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertNull($dateTimeField->getValue());
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
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setRequired($isRequired);
        $dateTimeField->setFormValue($value);

        self::assertSame($expectedValue, $dateTimeField->getValue() !== null ? $dateTimeField->getValue()->format('Y-m-d H:i:s') : null);
        self::assertSame($expectedIsEmpty, $dateTimeField->isEmpty());
        self::assertSame($expectedIsInvalid, $dateTimeField->isInvalid());
        self::assertSame($expectedHasError, $dateTimeField->hasError());
        self::assertSame($expectedError, $dateTimeField->getError());
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
            [false, '2017-10-15', '2017-10-15 00:00:00', false, false, false, null],
            [true, '2017-10-15', '2017-10-15 00:00:00', false, false, false, null],
            [false, ' 2017-10-15 ', '2017-10-15 00:00:00', false, false, false, null],
            [true, ' 2017-10-15 ', '2017-10-15 00:00:00', false, false, false, null],
            [false, '2017-10-15 12:34:56', '2017-10-15 12:34:00', false, false, false, null],
            [true, '2017-10-15 12:34:56', '2017-10-15 12:34:00', false, false, false, null],
            [false, ' 2017-10-15 12:34:56 ', '2017-10-15 12:34:00', false, false, false, null],
            [true, ' 2017-10-15 12:34:56 ', '2017-10-15 12:34:00', false, false, false, null],
            [false, ' 2017-10-15T12:34 ', '2017-10-15 12:34:00', false, false, false, null],
            [true, ' 2017-10-15T12:34 ', '2017-10-15 12:34:00', false, false, false, null],
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
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setFormValue(null);
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
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setFormValue($value);

        self::assertSame($expectedValue, $dateTimeField->getValue() !== null ? $dateTimeField->getValue()->format('Y-m-d H:i:s') : null);
        self::assertSame($expectedHtmlString, $dateTimeField->getHtml());
        self::assertSame($expectedHtmlString, $dateTimeField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, '<input type="datetime-local" name="foo" required>'],
            [' ', null, '<input type="datetime-local" name="foo" required>'],
            ['Foo Bar', null, '<input type="datetime-local" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', null, '<input type="datetime-local" name="foo" value="Foo  Bar" required>'],
            ['2017-01-01', '2017-01-01 00:00:00', '<input type="datetime-local" name="foo" value="2017-01-01" required>'],
            ['  2017-01-01  ', '2017-01-01 00:00:00', '<input type="datetime-local" name="foo" value="2017-01-01" required>'],
            ['2017-01-01 12:34:56', '2017-01-01 12:34:00', '<input type="datetime-local" name="foo" value="2017-01-01 12:34:56" required>'],
            ['  2017-01-01 12:34:56 ', '2017-01-01 12:34:00', '<input type="datetime-local" name="foo" value="2017-01-01 12:34:56" required>'],
            ['2017-01-01T12:34', '2017-01-01 12:34:00', '<input type="datetime-local" name="foo" value="2017-01-01T12:34" required>'],
            ['  2017-01-01T12:34 ', '2017-01-01 12:34:00', '<input type="datetime-local" name="foo" value="2017-01-01T12:34" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $dateTimeField = new DateTimeField('<p>');
        $dateTimeField->setFormValue('<em>');

        self::assertSame('<input type="datetime-local" name="&lt;p&gt;" value="&lt;em&gt;" required>', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="&lt;p&gt;" value="&lt;em&gt;" required>', $dateTimeField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertTrue($dateTimeField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $dateTimeField = new DateTimeField('foo', new \DateTimeImmutable());

        self::assertFalse($dateTimeField->isEmpty());
    }

    /**
     * Test isInvalid method for empty value.
     */
    public function testIsValidForEmptyValue()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertFalse($dateTimeField->isInvalid());
    }

    /**
     * Test isInvalid method for non-empty value.
     */
    public function testIsValidForNonEmptyValue()
    {
        $dateTimeField = new DateTimeField('foo', new \DateTimeImmutable());

        self::assertFalse($dateTimeField->isInvalid());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertFalse($dateTimeField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertNull($dateTimeField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setError('My Error');

        self::assertTrue($dateTimeField->hasError());
        self::assertSame('My Error', $dateTimeField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $dateTimeField = new DateTimeField('foo', new \DateTimeImmutable('2000-01-02 03:04:05'));

        self::assertSame('2000-01-02 03:04:00', $dateTimeField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="datetime-local" name="foo" value="2000-01-02T03:04" required>', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" value="2000-01-02T03:04" required>', $dateTimeField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $dateTimeField = new DateTimeField('foo', new \DateTimeImmutable('2000-01-02 03:04:05'));

        self::assertSame('<input type="datetime-local" name="foo" value="2000-01-02T03:04" required id="baz" readonly>', $dateTimeField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertTrue($dateTimeField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $dateTimeField = new DateTimeField('foo', new \DateTimeImmutable('2017-10-15 18:00:00'));
        $dateTimeField->setRequired(false);

        self::assertFalse($dateTimeField->isRequired());
        self::assertSame('<input type="datetime-local" name="foo" value="2017-10-15T18:00">', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" value="2017-10-15T18:00">', $dateTimeField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setRequired(0);
    }

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setFormValue("2018-\0\t01-\r\n02T01:02:00");

        self::assertSame('2018-01-02 01:02:00', $dateTimeField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="datetime-local" name="foo" value="2018-01-02T01:02:00" required>', $dateTimeField->__toString());
    }
}
