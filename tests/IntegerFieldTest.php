<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\IntegerField;
use PHPUnit\Framework\TestCase;

/**
 * Test IntegerField class.
 */
class IntegerFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $integerField = new IntegerField('foo');

        self::assertSame('<input type="number" name="foo" required>', $integerField->getHtml());
        self::assertSame('<input type="number" name="foo" required>', $integerField->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $integerField = new IntegerField('foo');

        self::assertSame('foo', $integerField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $integerField = new IntegerField('foo');

        self::assertNull($integerField->getValue());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired        True of value is required, false otherwise.
     * @param string      $value             The value.
     * @param int|null    $minimumValue      The minimum value or null if no minimum value.
     * @param int|null    $maximumValue      The maximum value or null if no maximum value.
     * @param int|null    $expectedValue     The expected value or null if no value.
     * @param bool        $expectedIsEmpty   The expected value from isEmpty method.
     * @param bool        $expectedIsInvalid The expected value from isInvalid method.
     * @param bool        $expectedHasError  The expected value from hasError method.
     * @param string|null $expectedError     The expected error or null if no error.
     */
    public function testSetFormValue(bool $isRequired, string $value, ?int $minimumValue, ?int $maximumValue, ?int $expectedValue, bool $expectedIsEmpty, bool $expectedIsInvalid, bool $expectedHasError, ?string $expectedError)
    {
        $integerField = new IntegerField('foo');
        $integerField->setRequired($isRequired);

        if ($minimumValue !== null) {
            $integerField->setMinimumValue($minimumValue);
        }

        if ($maximumValue !== null) {
            $integerField->setMaximumValue($maximumValue);
        }

        $integerField->setFormValue($value);

        self::assertSame($expectedValue, $integerField->getValue());
        self::assertSame($expectedIsEmpty, $integerField->isEmpty());
        self::assertSame($expectedIsInvalid, $integerField->isInvalid());
        self::assertSame($expectedHasError, $integerField->hasError());
        self::assertSame($expectedError, $integerField->getError());
    }

    /**
     * Data provider for testSetFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider()
    {
        return [
            [false, '', null, null, null, true, false, false, null],
            [true, '', null, null, null, true, false, true, 'Missing value'],
            [false, ' ', null, null, null, true, false, false, null],
            [true, ' ', null, null, null, true, false, true, 'Missing value'],
            [false, '10', null, null, 10, false, false, false, null],
            [true, '10', null, null, 10, false, false, false, null],
            [false, '0', null, null, 0, false, false, false, null],
            [true, '0', null, null, 0, false, false, false, null],
            [false, '-3', null, null, -3, false, false, false, null],
            [true, '-3', null, null, -3, false, false, false, null],
            [false, '  10  ', null, null, 10, false, false, false, null],
            [true, '  10  ', null, null, 10, false, false, false, null],
            [false, 'FooBar', null, null, null, false, true, true, 'Invalid value'],
            [true, 'FooBar', null, null, null, false, true, true, 'Invalid value'],
            [false, '10', 10, null, 10, false, false, false, null],
            [true, '10', 10, null, 10, false, false, false, null],
            [false, '10', 11, null, null, false, true, true, 'Invalid value'],
            [true, '10', 11, null, null, false, true, true, 'Invalid value'],
            [false, '10', null, 10, 10, false, false, false, null],
            [true, '10', null, 10, 10, false, false, false, null],
            [false, '10', null, 9, null, false, true, true, 'Invalid value'],
            [true, '10', null, 9, null, false, true, true, 'Invalid value'],
            [false, '-2', -1, 1, null, false, true, true, 'Invalid value'],
            [true, '-2', -1, 1, null, false, true, true, 'Invalid value'],
            [false, '-1', -1, 1, -1, false, false, false, null],
            [true, '-1', -1, 1, -1, false, false, false, null],
            [false, '0', -1, 1, 0, false, false, false, null],
            [true, '0', -1, 1, 0, false, false, false, null],
            [false, '1', -1, 1, 1, false, false, false, null],
            [true, '1', -1, 1, 1, false, false, false, null],
            [false, '2', -1, 1, null, false, true, true, 'Invalid value'],
            [true, '2', -1, 1, null, false, true, true, 'Invalid value'],
        ];
    }

    /**
     * Test text formatting.
     *
     * @dataProvider textFormattingDataProvider
     *
     * @param string   $value              The value
     * @param int|null $expectedValue      The expected value or null if no value.
     * @param string   $expectedHtmlString The expected html string.
     */
    public function testTextFormatting(string $value, ?int $expectedValue, string $expectedHtmlString)
    {
        $integerField = new IntegerField('foo');
        $integerField->setFormValue($value);

        self::assertSame($expectedValue, $integerField->getValue());
        self::assertSame($expectedHtmlString, $integerField->getHtml());
        self::assertSame($expectedHtmlString, $integerField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, '<input type="number" name="foo" required>'],
            [' ', null, '<input type="number" name="foo" required>'],
            ['1234', 1234, '<input type="number" name="foo" value="1234" required>'],
            ['  1234  ', 1234, '<input type="number" name="foo" value="1234" required>'],
            ['Foo Bar', null, '<input type="number" name="foo" value="Foo Bar" required>'],
            ['  Foo Bar  ', null, '<input type="number" name="foo" value="Foo Bar" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $integerField = new IntegerField('<p>');
        $integerField->setFormValue('<em>');

        self::assertSame('<input type="number" name="&lt;p&gt;" value="&lt;em&gt;" required>', $integerField->getHtml());
        self::assertSame('<input type="number" name="&lt;p&gt;" value="&lt;em&gt;" required>', $integerField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $integerField = new IntegerField('foo');

        self::assertTrue($integerField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $integerField = new IntegerField('foo', 42);

        self::assertFalse($integerField->isEmpty());
    }

    /**
     * Test isInvalid method for empty value.
     */
    public function testIsValidForEmptyValue()
    {
        $integerField = new IntegerField('foo');

        self::assertFalse($integerField->isInvalid());
    }

    /**
     * Test isInvalid method for non-empty value.
     */
    public function testIsValidForNonEmptyValue()
    {
        $integerField = new IntegerField('foo', 42);

        self::assertFalse($integerField->isInvalid());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $integerField = new IntegerField('foo');

        self::assertFalse($integerField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $integerField = new IntegerField('foo');

        self::assertNull($integerField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $integerField = new IntegerField('foo');
        $integerField->setError('My Error');

        self::assertTrue($integerField->hasError());
        self::assertSame('My Error', $integerField->getError());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $integerField = new IntegerField('foo', -1);

        self::assertSame(-1, $integerField->getValue());
        self::assertSame('<input type="number" name="foo" value="-1" required>', $integerField->getHtml());
        self::assertSame('<input type="number" name="foo" value="-1" required>', $integerField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $integerField = new IntegerField('foo', 0);

        self::assertSame('<input type="number" name="foo" value="0" required id="baz" readonly>', $integerField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $integerField = new IntegerField('foo');

        self::assertTrue($integerField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $integerField = new IntegerField('foo', 0);
        $integerField->setRequired(false);

        self::assertFalse($integerField->isRequired());
        self::assertSame('<input type="number" name="foo" value="0">', $integerField->getHtml());
        self::assertSame('<input type="number" name="foo" value="0">', $integerField->__toString());
    }

    /**
     * Test setMinimumValue method.
     */
    public function testSetMinimumValue()
    {
        $integerField = new IntegerField('foo');
        $integerField->setMinimumValue(2);
        self::assertSame('<input type="number" name="foo" required min="2">', $integerField->getHtml());
        self::assertSame('<input type="number" name="foo" required min="2">', $integerField->__toString());
    }

    /**
     * Test setMaximumValue method.
     */
    public function testSetMaximumValue()
    {
        $integerField = new IntegerField('foo');
        $integerField->setMaximumValue(-2);
        self::assertSame('<input type="number" name="foo" required max="-2">', $integerField->getHtml());
        self::assertSame('<input type="number" name="foo" required max="-2">', $integerField->__toString());
    }

    /**
     * Test text sanitation.
     */
    public function testTextSanitation()
    {
        $integerField = new IntegerField('foo');
        $integerField->setFormValue("1\0\t2\r\n3");

        self::assertSame(123, $integerField->getValue());
        self::assertSame('<input type="number" name="foo" value="123" required>', $integerField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $integerField = new IntegerField('foo');

        self::assertSame('', $integerField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $integerField = new IntegerField('foo');
        $integerField->setLabel('My label');

        self::assertSame('My label', $integerField->getLabel());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $integerField = new IntegerField('foo');

        self::assertNull($integerField->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $integerField = new IntegerField('foo');
        $integerField->setCustomData(null);

        self::assertNull($integerField->getCustomData());
    }
}
