<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\DateField;
use PHPUnit\Framework\TestCase;

/**
 * Test DateField class.
 */
class DateFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $dateField = new DateField('foo');

        self::assertSame('<input type="date" name="foo" required>', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" required>', $dateField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new DateField(null);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $dateField = new DateField('foo');

        self::assertSame('foo', $dateField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $dateField = new DateField('foo');

        self::assertNull($dateField->getValue());
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
        $dateField = new DateField('foo');
        $dateField->setRequired($isRequired);
        $dateField->setFormValue($value);

        self::assertSame($expectedValue, $dateField->getValue() !== null ? $dateField->getValue()->format('Y-m-d H:i:s') : null);
        self::assertSame($expectedIsEmpty, $dateField->isEmpty());
        self::assertSame($expectedIsInvalid, $dateField->isInvalid());
        self::assertSame($expectedHasError, $dateField->hasError());
        self::assertSame($expectedError, $dateField->getError());
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
            [false, '2017-10-15 23:59:59', '2017-10-15 00:00:00', false, false, false, null],
            [true, '2017-10-15 23:59:59', '2017-10-15 00:00:00', false, false, false, null],
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
        $dateField = new DateField('foo');
        $dateField->setFormValue(null);
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
        $dateField = new DateField('foo');
        $dateField->setFormValue($value);

        self::assertSame($expectedValue, $dateField->getValue() !== null ? $dateField->getValue()->format('Y-m-d H:i:s') : null);
        self::assertSame($expectedHtmlString, $dateField->getHtml());
        self::assertSame($expectedHtmlString, $dateField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, '<input type="date" name="foo" required>'],
            [' ', null, '<input type="date" name="foo" required>'],
            ['Foo Bar', null, '<input type="date" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', null, '<input type="date" name="foo" value="Foo  Bar" required>'],
            ['2017-01-01', '2017-01-01 00:00:00', '<input type="date" name="foo" value="2017-01-01" required>'],
            ['  2017-01-01  ', '2017-01-01 00:00:00', '<input type="date" name="foo" value="2017-01-01" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $dateField = new DateField('<p>');
        $dateField->setFormValue('<em>');

        self::assertSame('<input type="date" name="&lt;p&gt;" value="&lt;em&gt;" required>', $dateField->getHtml());
        self::assertSame('<input type="date" name="&lt;p&gt;" value="&lt;em&gt;" required>', $dateField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $dateField = new DateField('foo');

        self::assertTrue($dateField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $dateField = new DateField('foo', new \DateTimeImmutable());

        self::assertFalse($dateField->isEmpty());
    }

    /**
     * Test isInvalid method for empty value.
     */
    public function testIsValidForEmptyValue()
    {
        $dateField = new DateField('foo');

        self::assertFalse($dateField->isInvalid());
    }

    /**
     * Test isInvalid method for non-empty value.
     */
    public function testIsValidForNonEmptyValue()
    {
        $dateField = new DateField('foo', new \DateTimeImmutable());

        self::assertFalse($dateField->isInvalid());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $dateField = new DateField('foo');

        self::assertFalse($dateField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $dateField = new DateField('foo');

        self::assertNull($dateField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $dateField = new DateField('foo');
        $dateField->setError('My Error');

        self::assertTrue($dateField->hasError());
        self::assertSame('My Error', $dateField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $dateField = new DateField('foo');
        $dateField->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $dateField = new DateField('foo', new \DateTimeImmutable('2000-01-02 03:04:05'));

        self::assertSame('2000-01-02 00:00:00', $dateField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="date" name="foo" value="2000-01-02" required>', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" value="2000-01-02" required>', $dateField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $dateField = new DateField('foo', new \DateTimeImmutable('2000-01-02'));

        self::assertSame('<input type="date" name="foo" value="2000-01-02" required id="baz" readonly>', $dateField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $dateField = new DateField('foo');

        self::assertTrue($dateField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $dateField = new DateField('foo', new \DateTimeImmutable('2017-10-15'));
        $dateField->setRequired(false);

        self::assertFalse($dateField->isRequired());
        self::assertSame('<input type="date" name="foo" value="2017-10-15">', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" value="2017-10-15">', $dateField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $dateField = new DateField('foo');
        $dateField->setRequired(0);
    }

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $dateField = new DateField('foo');
        $dateField->setFormValue("2018-\0\t01-\r\n02");

        self::assertSame('2018-01-02 00:00:00', $dateField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="date" name="foo" value="2018-01-02" required>', $dateField->__toString());
    }
}
