<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Forms\DateField;
use DateTimeImmutable;
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
        $dateField = new DateField('foo');
        $dateField->setRequired($isRequired);

        if ($minimumValue !== null) {
            $dateField->setMinimumValue(new DateTimeImmutable($minimumValue));
        }

        if ($maximumValue !== null) {
            $dateField->setMaximumValue(new DateTimeImmutable($maximumValue));
        }

        $dateField->setFormValue($value);

        self::assertSame($expectedValue, $dateField->getValue()?->format('Y-m-d H:i:s'));
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
            [false, '2017-10-15 23:59:59', null, null, '2017-10-15 00:00:00', false, false, false, null],
            [true, '2017-10-15 23:59:59', null, null, '2017-10-15 00:00:00', false, false, false, null],
            [true, '2017-10-15', '2017-10-16', null, null, false, true, true, 'Invalid value'],
            [true, '2017-10-16', '2017-10-16', '2017-10-18', '2017-10-16 00:00:00', false, false, false, null],
            [true, '2017-10-16', '2017-10-16 12:00:00', '2017-10-18', '2017-10-16 00:00:00', false, false, false, null],
            [true, '2017-10-17', '2017-10-16', '2017-10-18', '2017-10-17 00:00:00', false, false, false, null],
            [true, '2017-10-18', '2017-10-16', '2017-10-18', '2017-10-18 00:00:00', false, false, false, null],
            [true, '2017-10-19', null, '2017-10-18', null, false, true, true, 'Invalid value'],
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
        $dateField = new DateField('foo');
        $dateField->setFormValue($value);

        self::assertSame($expectedValue, $dateField->getValue()?->format('Y-m-d H:i:s'));
        self::assertSame($expectedHtmlString, $dateField->getHtml());
        self::assertSame($expectedHtmlString, $dateField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider(): array
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
        $dateField = new DateField('foo', new DateTimeImmutable());

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
        $dateField = new DateField('foo', new DateTimeImmutable());

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
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $dateField = new DateField('foo', new DateTimeImmutable('2000-01-02 03:04:05'));

        self::assertSame('2000-01-02 00:00:00', $dateField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="date" name="foo" value="2000-01-02" required>', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" value="2000-01-02" required>', $dateField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $dateField = new DateField('foo', new DateTimeImmutable('2000-01-02'));

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
        $dateField = new DateField('foo', new DateTimeImmutable('2017-10-15'));
        $dateField->setRequired(false);

        self::assertFalse($dateField->isRequired());
        self::assertSame('<input type="date" name="foo" value="2017-10-15">', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" value="2017-10-15">', $dateField->__toString());
    }

    /**
     * Test text sanitation.
     */
    public function testTextSanitation()
    {
        $dateField = new DateField('foo');
        $dateField->setFormValue("2018-\0\t01-\r\n02");

        self::assertSame('2018-01-02 00:00:00', $dateField->getValue()->format('Y-m-d H:i:s'));
        self::assertSame('<input type="date" name="foo" value="2018-01-02" required>', $dateField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $dateField = new DateField('foo');

        self::assertSame('', $dateField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $dateField = new DateField('foo');
        $dateField->setLabel('My label');

        self::assertSame('My label', $dateField->getLabel());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $dateField = new DateField('foo');

        self::assertFalse($dateField->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $dateField = new DateField('foo');
        $dateField->setDisabled(true);

        self::assertTrue($dateField->isDisabled());
        self::assertSame('<input type="date" name="foo" required disabled>', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" required disabled>', $dateField->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $dateField = new DateField('foo');

        self::assertNull($dateField->getCustomItem('Foo'));
        self::assertNull($dateField->getCustomItem('Bar'));
        self::assertNull($dateField->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $dateField = new DateField('foo');
        $dateField->setCustomItem('Foo', 1234);
        $dateField->setCustomItem('Bar', true);

        self::assertSame(1234, $dateField->getCustomItem('Foo'));
        self::assertTrue($dateField->getCustomItem('Bar'));
        self::assertNull($dateField->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $dateField = new DateField('foo');
        $dateField->setCustomItem('Bar', 0.0);
        $dateField->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($dateField->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $dateField = new DateField('foo');
        $dateField->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $dateField->getCustomItem('Foo'));
        self::assertNull($dateField->getCustomItem('Bar'));
        self::assertFalse($dateField->getCustomItem('Baz'));
    }

    /**
     * Test set an invalid text.
     */
    public function testSetInvalidText()
    {
        $dateField = new DateField('foo');
        $dateField->setFormValue('Foo' . chr(128));

        self::assertNull($dateField->getValue());
    }

    /**
     * Test setMinimumValue method.
     */
    public function testSetMinimumValue()
    {
        $dateField = new DateField('foo');
        $dateField->setMinimumValue(new DateTimeImmutable('2025-01-07 21:00:00'));

        self::assertSame('<input type="date" name="foo" required min="2025-01-07">', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" required min="2025-01-07">', $dateField->__toString());
    }

    /**
     * Test setMaximumValue method.
     */
    public function testSetMaximumValue()
    {
        $dateField = new DateField('foo');
        $dateField->setMaximumValue(new DateTimeImmutable('2025-01-07 21:00:00'));

        self::assertSame('<input type="date" name="foo" required max="2025-01-07">', $dateField->getHtml());
        self::assertSame('<input type="date" name="foo" required max="2025-01-07">', $dateField->__toString());
    }
}
