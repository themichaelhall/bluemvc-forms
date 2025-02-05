<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Forms\DateTimeField;
use DateTimeImmutable;
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
     * @param string|null $minimumValue      The minimum value or null if no minimum value.
     * @param string|null $maximumValue      The maximum value or null if no maximum value.
     * @param string|null $expectedValue     The expected value or null if no value.
     * @param bool        $expectedIsEmpty   The expected value from isEmpty method.
     * @param bool        $expectedIsInvalid The expected value from isInvalid method.
     * @param bool        $expectedHasError  The expected value from hasError method.
     * @param string|null $expectedError     The expected error or null if no error.
     */
    public function testSetFormValue(
        bool $isRequired,
        string $value,
        ?string $minimumValue,
        ?string $maximumValue,
        ?string $expectedValue,
        bool $expectedIsEmpty,
        bool $expectedIsInvalid,
        bool $expectedHasError,
        ?string $expectedError
    ) {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setRequired($isRequired);

        if ($minimumValue !== null) {
            $dateTimeField->setMinimumValue(new DateTimeImmutable($minimumValue));
        }

        if ($maximumValue !== null) {
            $dateTimeField->setMaximumValue(new DateTimeImmutable($maximumValue));
        }

        $dateTimeField->setFormValue($value);

        self::assertSame($expectedValue, $dateTimeField->getValue()?->format('Y-m-d H:i:s'));
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
    public function setFormValueDataProvider(): array
    {
        return [
            [false, '', null, null, null, true, false, false, null],
            [true, '', null, null, null, true, false, true, 'Missing value'],
            [false, ' ', null, null, null, true, false, false, null],
            [true, ' ', null, null, null, true, false, true, 'Missing value'],
            [false, 'FooBar', null, null, null, false, true, true, 'Invalid value'],
            [true, 'FooBar', null, null, null, false, true, true, 'Invalid value'],
            [false, '2017-10-15', null, null, '2017-10-15 00:00:00', false, false, false, null],
            [true, '2017-10-15', null, null, '2017-10-15 00:00:00', false, false, false, null],
            [false, ' 2017-10-15 ', null, null, '2017-10-15 00:00:00', false, false, false, null],
            [true, ' 2017-10-15 ', null, null, '2017-10-15 00:00:00', false, false, false, null],
            [false, '2017-10-15 12:34:56', null, null, '2017-10-15 12:34:00', false, false, false, null],
            [true, '2017-10-15 12:34:56', null, null, '2017-10-15 12:34:00', false, false, false, null],
            [false, ' 2017-10-15 12:34:56 ', null, null, '2017-10-15 12:34:00', false, false, false, null],
            [true, ' 2017-10-15 12:34:56 ', null, null, '2017-10-15 12:34:00', false, false, false, null],
            [false, ' 2017-10-15T12:34 ', null, null, '2017-10-15 12:34:00', false, false, false, null],
            [true, ' 2017-10-15T12:34 ', null, null, '2017-10-15 12:34:00', false, false, false, null],
            [true, '2017-10-15T12:34', '2017-10-16 12:34:56', null, null, false, true, true, 'Invalid value'],
            [true, '2017-10-16T12:34', '2017-10-16 12:34:00', '2017-10-18 12:34:56', '2017-10-16 12:34:00', false, false, false, null],
            [true, '2017-10-16T12:34', '2017-10-16 12:34:56', '2017-10-18 12:34:56', '2017-10-16 12:34:00', false, false, false, null],
            [true, '2017-10-17T00:00', '2017-10-16 12:34:56', '2017-10-18 12:34:56', '2017-10-17 00:00:00', false, false, false, null],
            [true, '2017-10-18T00:00', '2017-10-16 12:34:56', '2017-10-18 00:00:00', '2017-10-18 00:00:00', false, false, false, null],
            [true, '2017-10-18T00:01', null, '2017-10-18 00:00:00', null, false, true, true, 'Invalid value'],
        ];
    }

    /**
     * Test text formatting.
     *
     * @dataProvider textFormattingDataProvider
     *
     * @param string      $value              The value
     * @param string|null $expectedValue      The expected value or null if no value.
     * @param string      $expectedHtmlString The expected html string.
     */
    public function testTextFormatting(string $value, ?string $expectedValue, string $expectedHtmlString)
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setFormValue($value);

        self::assertSame($expectedValue, $dateTimeField->getValue()?->format('Y-m-d H:i:s'));
        self::assertSame($expectedHtmlString, $dateTimeField->getHtml());
        self::assertSame($expectedHtmlString, $dateTimeField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider(): array
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
        $dateTimeField = new DateTimeField('foo', new DateTimeImmutable());

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
        $dateTimeField = new DateTimeField('foo', new DateTimeImmutable());

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
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $dateTimeField = new DateTimeField('foo', new DateTimeImmutable('2000-01-02 03:04:05'));

        self::assertSame('2000-01-02 03:04:00', $dateTimeField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="datetime-local" name="foo" value="2000-01-02T03:04" required>', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" value="2000-01-02T03:04" required>', $dateTimeField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $dateTimeField = new DateTimeField('foo', new DateTimeImmutable('2000-01-02 03:04:05'));

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
        $dateTimeField = new DateTimeField('foo', new DateTimeImmutable('2017-10-15 18:00:00'));
        $dateTimeField->setRequired(false);

        self::assertFalse($dateTimeField->isRequired());
        self::assertSame('<input type="datetime-local" name="foo" value="2017-10-15T18:00">', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" value="2017-10-15T18:00">', $dateTimeField->__toString());
    }

    /**
     * Test text sanitation.
     */
    public function testTextSanitation()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setFormValue("2018-\0\t01-\r\n02T01:02:00");

        self::assertSame('2018-01-02 01:02:00', $dateTimeField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="datetime-local" name="foo" value="2018-01-02T01:02:00" required>', $dateTimeField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertSame('', $dateTimeField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setLabel('My label');

        self::assertSame('My label', $dateTimeField->getLabel());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertFalse($dateTimeField->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setDisabled(true);

        self::assertTrue($dateTimeField->isDisabled());
        self::assertSame('<input type="datetime-local" name="foo" required disabled>', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" required disabled>', $dateTimeField->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $dateTimeField = new DateTimeField('foo');

        self::assertNull($dateTimeField->getCustomItem('Foo'));
        self::assertNull($dateTimeField->getCustomItem('Bar'));
        self::assertNull($dateTimeField->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setCustomItem('Foo', 1234);
        $dateTimeField->setCustomItem('Bar', true);

        self::assertSame(1234, $dateTimeField->getCustomItem('Foo'));
        self::assertTrue($dateTimeField->getCustomItem('Bar'));
        self::assertNull($dateTimeField->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setCustomItem('Bar', 0.0);
        $dateTimeField->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($dateTimeField->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $dateTimeField->getCustomItem('Foo'));
        self::assertNull($dateTimeField->getCustomItem('Bar'));
        self::assertFalse($dateTimeField->getCustomItem('Baz'));
    }

    /**
     * Test set an invalid text.
     */
    public function testSetInvalidText()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setFormValue('Foo' . chr(128));

        self::assertNull($dateTimeField->getValue());
    }

    /**
     * Test setMinimumValue method.
     */
    public function testSetMinimumValue()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setMinimumValue(new DateTimeImmutable('2025-01-08 18:19:20'));

        self::assertSame('<input type="datetime-local" name="foo" required min="2025-01-08T18:19">', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" required min="2025-01-08T18:19">', $dateTimeField->__toString());
    }

    /**
     * Test setMaximumValue method.
     */
    public function testSetMaximumValue()
    {
        $dateTimeField = new DateTimeField('foo');
        $dateTimeField->setMaximumValue(new DateTimeImmutable('2025-01-08 18:19:20'));

        self::assertSame('<input type="datetime-local" name="foo" required max="2025-01-08T18:19">', $dateTimeField->getHtml());
        self::assertSame('<input type="datetime-local" name="foo" required max="2025-01-08T18:19">', $dateTimeField->__toString());
    }
}
