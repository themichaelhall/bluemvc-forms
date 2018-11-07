<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\TextField;
use BlueMvc\Forms\TextFormatOptions;
use PHPUnit\Framework\TestCase;

/**
 * Test TextField class.
 */
class TextFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $textField = new TextField('foo');

        self::assertSame('<input type="text" name="foo" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" required>', $textField->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $textField = new TextField('foo');

        self::assertSame('foo', $textField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $textField = new TextField('foo');

        self::assertSame('', $textField->getValue());
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
    public function testSetFormValue(bool $isRequired, string $value, ?string $expectedValue, bool $expectedIsEmpty, bool $expectedHasError, ?string $expectedError)
    {
        $textField = new TextField('foo');
        $textField->setRequired($isRequired);
        $textField->setFormValue($value);

        self::assertSame($expectedValue, $textField->getValue());
        self::assertSame($expectedIsEmpty, $textField->isEmpty());
        self::assertSame($expectedHasError, $textField->hasError());
        self::assertSame($expectedError, $textField->getError());
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
            [false, ' Foo  Bar Baz ', 'Foo Bar Baz', false, false, null],
            [true, ' Foo  Bar Baz ', 'Foo Bar Baz', false, false, null],
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
        $textField = $textFormatOptions !== null ?
            new TextField('foo', '', $textFormatOptions) :
            new TextField('foo');
        $textField->setFormValue($value);

        self::assertSame($expectedValue, $textField->getValue());
        self::assertSame($expectedHtmlString, $textField->getHtml());
        self::assertSame($expectedHtmlString, $textField->__toString());
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
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $textField = new TextField('<p>');
        $textField->setFormValue('<em>');

        self::assertSame('<input type="text" name="&lt;p&gt;" value="&lt;em&gt;" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="&lt;p&gt;" value="&lt;em&gt;" required>', $textField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $textField = new TextField('foo');

        self::assertTrue($textField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $textField = new TextField('foo');
        $textField->setFormValue('bar');

        self::assertFalse($textField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $textField = new TextField('foo');

        self::assertFalse($textField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $textField = new TextField('foo');

        self::assertNull($textField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $textField = new TextField('foo');
        $textField->setError('My Error');

        self::assertTrue($textField->hasError());
        self::assertSame('My Error', $textField->getError());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $textField = new TextField('foo', 'bar');

        self::assertSame('bar', $textField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->__toString());
    }

    /**
     * Test that value is formatted in constructor.
     */
    public function testValueIsFormattedInConstructor()
    {
        $textField = new TextField('foo', ' bar ');

        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $textField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $textField = new TextField('foo', 'bar');

        self::assertSame('<input type="text" name="foo" value="bar" required id="baz" readonly>', $textField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $textField = new TextField('foo');

        self::assertTrue($textField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $textField = new TextField('foo', 'bar');
        $textField->setRequired(false);

        self::assertFalse($textField->isRequired());
        self::assertSame('<input type="text" name="foo" value="bar">', $textField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar">', $textField->__toString());
    }

    /**
     * Test text sanitation.
     */
    public function testTextSanitation()
    {
        $textField = new TextField('foo');
        $textField->setFormValue("Foo\0\tBar\r\nBaz");

        self::assertSame('FooBarBaz', $textField->getValue());
        self::assertSame('<input type="text" name="foo" value="FooBarBaz" required>', $textField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $textField = new TextField('foo');

        self::assertSame('', $textField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $textField = new TextField('foo');
        $textField->setLabel('My label');

        self::assertSame('My label', $textField->getLabel());
    }
}
