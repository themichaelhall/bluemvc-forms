<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Tests\Helpers\TestFormElements\NameField;
use BlueMvc\Forms\TextFormatOptions;
use PHPUnit\Framework\TestCase;

/**
 * Test NameField class.
 */
class NameFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $nameField = new NameField('foo');

        self::assertSame('<input type="text" name="foo" required>', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" required>', $nameField->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $nameField = new NameField('foo');

        self::assertSame('foo', $nameField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $nameField = new NameField('foo');

        self::assertSame('', $nameField->getValue());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired       True of value is required, false otherwise.
     * @param string      $value            The value.
     * @param string      $expectedValue    The expected value.
     * @param bool        $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool        $expectedHasError The expected value from hasError method.
     * @param string|null $expectedError    The expected error or null if no error.
     */
    public function testSetFormValue(bool $isRequired, string $value, string $expectedValue, bool $expectedIsEmpty, bool $expectedHasError, ?string $expectedError)
    {
        $nameField = new NameField('foo');
        $nameField->setRequired($isRequired);
        $nameField->setFormValue($value);

        self::assertSame($expectedValue, $nameField->getValue());
        self::assertSame($expectedIsEmpty, $nameField->isEmpty());
        self::assertSame($expectedHasError, $nameField->hasError());
        self::assertSame($expectedError, $nameField->getError());
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
            [false, ' ', '', true, false, null],
            [true, ' ', '', true, true, 'Missing value'],
            [false, 'FooBar', 'FooBar', false, false, null],
            [true, 'FooBar', 'FooBar', false, false, null],
            [false, ' foo  bar baz ', 'Foo Bar Baz', false, false, null],
            [true, ' foo  bar baz ', 'Foo Bar Baz', false, false, null],
        ];
    }

    /**
     * Test text formatting.
     *
     * @dataProvider textFormattingDataProvider
     *
     * @param string   $value              The value
     * @param int|null $textFormatOptions  The text format options or null to use default.
     * @param string   $expectedValue      The expected value.
     * @param string   $expectedHtmlString The expected html string.
     */
    public function testTextFormatting(string $value, ?int $textFormatOptions, string $expectedValue, string $expectedHtmlString)
    {
        $nameField = $textFormatOptions !== null ?
            new NameField('foo', '', $textFormatOptions) :
            new NameField('foo');
        $nameField->setFormValue($value);

        self::assertSame($expectedValue, $nameField->getValue());
        self::assertSame($expectedHtmlString, $nameField->getHtml());
        self::assertSame($expectedHtmlString, $nameField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, '', '<input type="text" name="foo" required>'],
            ['', TextFormatOptions::NONE, '', '<input type="text" name="foo" required>'],
            ['', TextFormatOptions::TRIM, '', '<input type="text" name="foo" required>'],
            ['', TextFormatOptions::COMPACT, '', '<input type="text" name="foo" required>'],
            ['', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<input type="text" name="foo" required>'],
            [' ', null, '', '<input type="text" name="foo" required>'],
            [' ', TextFormatOptions::NONE, ' ', '<input type="text" name="foo" value=" " required>'],
            [' ', TextFormatOptions::TRIM, '', '<input type="text" name="foo" required>'],
            [' ', TextFormatOptions::COMPACT, ' ', '<input type="text" name="foo" value=" " required>'],
            [' ', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<input type="text" name="foo" required>'],
            ['Foo Bar', null, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['Foo Bar', TextFormatOptions::NONE, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['Foo Bar', TextFormatOptions::TRIM, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['Foo Bar', TextFormatOptions::COMPACT, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['Foo Bar', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', null, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', TextFormatOptions::NONE, '  Foo  Bar  ', '<input type="text" name="foo" value="  Foo  Bar  " required>'],
            ['  Foo  Bar  ', TextFormatOptions::TRIM, 'Foo  Bar', '<input type="text" name="foo" value="Foo  Bar" required>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT, ' Foo Bar ', '<input type="text" name="foo" value=" Foo Bar " required>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['  foo  bar  ', null, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
            ['  foo  bar  ', TextFormatOptions::NONE, '  Foo  Bar  ', '<input type="text" name="foo" value="  Foo  Bar  " required>'],
            ['  foo  bar  ', TextFormatOptions::TRIM, 'Foo  Bar', '<input type="text" name="foo" value="Foo  Bar" required>'],
            ['  foo  bar  ', TextFormatOptions::COMPACT, ' Foo Bar ', '<input type="text" name="foo" value=" Foo Bar " required>'],
            ['  foo  bar  ', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<input type="text" name="foo" value="Foo Bar" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $nameField = new NameField('<p>');
        $nameField->setFormValue('<em>');

        self::assertSame('<input type="text" name="&lt;p&gt;" value="&lt;em&gt;" required>', $nameField->getHtml());
        self::assertSame('<input type="text" name="&lt;p&gt;" value="&lt;em&gt;" required>', $nameField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $nameField = new NameField('foo');

        self::assertTrue($nameField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $nameField = new NameField('foo');
        $nameField->setFormValue('bar');

        self::assertFalse($nameField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $nameField = new NameField('foo');

        self::assertFalse($nameField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $nameField = new NameField('foo');

        self::assertNull($nameField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $nameField = new NameField('foo');
        $nameField->setError('My Error');

        self::assertTrue($nameField->hasError());
        self::assertSame('My Error', $nameField->getError());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $nameField = new NameField('foo', 'Bar');

        self::assertSame('Bar', $nameField->getValue());
        self::assertSame('<input type="text" name="foo" value="Bar" required>', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" value="Bar" required>', $nameField->__toString());
    }

    /**
     * Test that value is formatted in constructor.
     */
    public function testValueIsFormattedInConstructor()
    {
        $textField = new NameField('foo', ' bar  baz ');

        self::assertSame('<input type="text" name="foo" value="Bar Baz" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="Bar Baz" required>', $textField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $nameField = new NameField('foo', 'Bar');

        self::assertSame('<input type="text" name="foo" value="Bar" required id="baz" readonly>', $nameField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $nameField = new NameField('foo');

        self::assertTrue($nameField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $nameField = new NameField('foo', 'Bar');
        $nameField->setRequired(false);

        self::assertFalse($nameField->isRequired());
        self::assertSame('<input type="text" name="foo" value="Bar">', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" value="Bar">', $nameField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $nameField = new NameField('foo');

        self::assertSame('', $nameField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $nameField = new NameField('foo');
        $nameField->setLabel('My label');

        self::assertSame('My label', $nameField->getLabel());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $nameField = new NameField('foo');

        self::assertNull($nameField->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $nameField = new NameField('foo');
        $nameField->setCustomData('Foo Bar');

        self::assertSame('Foo Bar', $nameField->getCustomData());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $nameField = new NameField('foo');

        self::assertFalse($nameField->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $nameField = new NameField('foo');
        $nameField->setDisabled(true);

        self::assertTrue($nameField->isDisabled());
    }
}
