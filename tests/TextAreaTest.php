<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\TextArea;
use BlueMvc\Forms\TextFormatOptions;
use PHPUnit\Framework\TestCase;

/**
 * Test TextArea class.
 */
class TextAreaTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $textArea = new TextArea('foo');

        self::assertSame('<textarea name="foo" required></textarea>', $textArea->getHtml());
        self::assertSame('<textarea name="foo" required></textarea>', $textArea->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new TextArea(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $textArea = new TextArea('foo');

        self::assertSame('foo', $textArea->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $textArea = new TextArea('foo');

        self::assertSame('', $textArea->getValue());
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
        $textArea = new TextArea('foo');
        $textArea->setRequired($isRequired);
        $textArea->setFormValue($value);

        self::assertSame($expectedValue, $textArea->getValue());
        self::assertSame($expectedIsEmpty, $textArea->isEmpty());
        self::assertSame($expectedHasError, $textArea->hasError());
        self::assertSame($expectedError, $textArea->getError());
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
            [false, " \r\n ", '', true, false, null],
            [true, " \r\n ", '', true, true, 'Missing value'],
            [false, 'FooBar', 'FooBar', false, false, null],
            [true, 'FooBar', 'FooBar', false, false, null],
            [false, ' Foo  Bar Baz ', 'Foo Bar Baz', false, false, null],
            [true, ' Foo  Bar Baz ', 'Foo Bar Baz', false, false, null],
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
        $textArea = new TextArea('foo');
        $textArea->setFormValue(true);
    }

    /**
     * Test constructor with invalid text format options parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $textFormatOptions parameter is not an integer.
     */
    public function testConstructorWithInvalidTextFormatOptionsParameterType()
    {
        new TextArea('foo', 'bar', true);
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
    public function testTextFormatting($value, $textFormatOptions, $expectedValue, $expectedHtmlString)
    {
        $textArea = $textFormatOptions !== null ?
            new TextArea('foo', '', $textFormatOptions) :
            new TextArea('foo');
        $textArea->setFormValue($value);

        self::assertSame($expectedValue, $textArea->getValue());
        self::assertSame($expectedHtmlString, $textArea->getHtml());
        self::assertSame($expectedHtmlString, $textArea->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::NONE, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::TRIM_LINES, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', null, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::NONE, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::COMPACT, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::TRIM_LINES, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['Foo Bar', null, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::NONE, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::TRIM_LINES, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', null, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::NONE, '  Foo  Bar  ', '<textarea name="foo" required>  Foo  Bar  </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::TRIM, 'Foo  Bar', '<textarea name="foo" required>Foo  Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT, ' Foo Bar ', '<textarea name="foo" required> Foo Bar </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::TRIM_LINES, '  Foo  Bar  ', '<textarea name="foo" required>  Foo  Bar  </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, 'Foo  Bar', '<textarea name="foo" required>Foo  Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, ' Foo Bar ', '<textarea name="foo" required> Foo Bar </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES, '  Foo  Bar  ', '<textarea name="foo" required>  Foo  Bar  </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, 'Foo  Bar', '<textarea name="foo" required>Foo  Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, ' Foo Bar ', '<textarea name="foo" required> Foo Bar </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, '  Foo  Bar  ', '<textarea name="foo" required>  Foo  Bar  </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, 'Foo  Bar', '<textarea name="foo" required>Foo  Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, ' Foo Bar ', '<textarea name="foo" required> Foo Bar </textarea>'],
            ['  Foo  Bar  ', TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ["  Foo  Bar  \r\n  Baz  ", null, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::NONE, "  Foo  Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo  Bar  \r\n  Baz  </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::TRIM, "Foo  Bar\r\nBaz", "<textarea name=\"foo\" required>Foo  Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT, " Foo Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo Bar \r\n Baz </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::TRIM_LINES, "  Foo  Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo  Bar  \r\n  Baz  </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, "Foo  Bar\r\nBaz", "<textarea name=\"foo\" required>Foo  Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, " Foo Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo Bar \r\n Baz </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES, "  Foo  Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo  Bar  \r\n  Baz  </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, "Foo  Bar\r\nBaz", "<textarea name=\"foo\" required>Foo  Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, " Foo Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo Bar \r\n Baz </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, "  Foo  Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo  Bar  \r\n  Baz  </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, "Foo  Bar\r\nBaz", "<textarea name=\"foo\" required>Foo  Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, " Foo Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo Bar \r\n Baz </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", null, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::NONE, "  Foo \r\n Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo \r\n Bar  \r\n  Baz  </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT, " Foo \r\n Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo \r\n Bar \r\n Baz </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::TRIM_LINES, "  Foo \r\n Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo \r\n Bar  \r\n  Baz  </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, " Foo \r\n Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo \r\n Bar \r\n Baz </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES, "  Foo \r\n Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo \r\n Bar  \r\n  Baz  </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, " Foo \r\n Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo \r\n Bar \r\n Baz </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, "  Foo \r\n Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo \r\n Bar  \r\n  Baz  </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, " Foo \r\n Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo \r\n Bar \r\n Baz </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", null, "Foo\r\n\r\nBar\r\n\r\nBaz", "<textarea name=\"foo\" required>Foo\r\n\r\nBar\r\n\r\nBaz</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::NONE, "\r\n\r\n  Foo \r\n\r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n \r\n", "<textarea name=\"foo\" required>\r\n\r\n  Foo \r\n\r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n \r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::TRIM, "\r\n\r\nFoo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz\r\n\r\n", "<textarea name=\"foo\" required>\r\n\r\nFoo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz\r\n\r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT, "\r\n\r\n Foo \r\n\r\n\r\n Bar \r\n \r\n \r\n Baz \r\n \r\n", "<textarea name=\"foo\" required>\r\n\r\n Foo \r\n\r\n\r\n Bar \r\n \r\n \r\n Baz \r\n \r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "\r\n\r\nFoo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz\r\n\r\n", "<textarea name=\"foo\" required>\r\n\r\nFoo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz\r\n\r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::TRIM_LINES, "  Foo \r\n\r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n ", "<textarea name=\"foo\" required>  Foo \r\n\r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n </textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, "Foo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz", "<textarea name=\"foo\" required>Foo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, " Foo \r\n\r\n\r\n Bar \r\n \r\n \r\n Baz \r\n ", "<textarea name=\"foo\" required> Foo \r\n\r\n\r\n Bar \r\n \r\n \r\n Baz \r\n </textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz", "<textarea name=\"foo\" required>Foo\r\n\r\n\r\nBar\r\n\r\n\r\nBaz</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES, "\r\n  Foo \r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n \r\n", "<textarea name=\"foo\" required>\r\n  Foo \r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n \r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM, "\r\nFoo\r\n\r\nBar\r\n\r\nBaz\r\n", "<textarea name=\"foo\" required>\r\nFoo\r\n\r\nBar\r\n\r\nBaz\r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT, "\r\n Foo \r\n\r\n Bar \r\n \r\n \r\n Baz \r\n \r\n", "<textarea name=\"foo\" required>\r\n Foo \r\n\r\n Bar \r\n \r\n \r\n Baz \r\n \r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "\r\nFoo\r\n\r\nBar\r\n\r\nBaz\r\n", "<textarea name=\"foo\" required>\r\nFoo\r\n\r\nBar\r\n\r\nBaz\r\n</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES, "  Foo \r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n ", "<textarea name=\"foo\" required>  Foo \r\n\r\n Bar  \r\n \r\n \r\n Baz  \r\n </textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::TRIM, "Foo\r\n\r\nBar\r\n\r\nBaz", "<textarea name=\"foo\" required>Foo\r\n\r\nBar\r\n\r\nBaz</textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT, " Foo \r\n\r\n Bar \r\n \r\n \r\n Baz \r\n ", "<textarea name=\"foo\" required> Foo \r\n\r\n Bar \r\n \r\n \r\n Baz \r\n </textarea>"],
            ["\r\r  Foo \n\n\n Bar  \r \n \n Baz  \r\n \n", TextFormatOptions::COMPACT_LINES | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT | TextFormatOptions::TRIM, "Foo\r\n\r\nBar\r\n\r\nBaz", "<textarea name=\"foo\" required>Foo\r\n\r\nBar\r\n\r\nBaz</textarea>"],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $textArea = new TextArea('<p>');
        $textArea->setFormValue('<em>');

        self::assertSame('<textarea name="&lt;p&gt;" required>&lt;em&gt;</textarea>', $textArea->getHtml());
        self::assertSame('<textarea name="&lt;p&gt;" required>&lt;em&gt;</textarea>', $textArea->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $textArea = new TextArea('foo');

        self::assertTrue($textArea->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $textArea = new TextArea('foo');
        $textArea->setFormValue('bar');

        self::assertFalse($textArea->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $textArea = new TextArea('foo');

        self::assertFalse($textArea->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $textArea = new TextArea('foo');

        self::assertNull($textArea->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $textArea = new TextArea('foo');
        $textArea->setError('My Error');

        self::assertTrue($textArea->hasError());
        self::assertSame('My Error', $textArea->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $textArea = new TextArea('foo');
        $textArea->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $textArea = new TextArea('foo', 'bar');

        self::assertSame('bar', $textArea->getValue());
        self::assertSame('<textarea name="foo" required>bar</textarea>', $textArea->getHtml());
        self::assertSame('<textarea name="foo" required>bar</textarea>', $textArea->__toString());
    }

    /**
     * Test constructor with default value with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithDefaultValueWithInvalidParameterType()
    {
        new TextArea('foo', false);
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $textArea = new TextArea('foo', 'bar');

        self::assertSame('<textarea name="foo" required id="baz" readonly rows="10">bar</textarea>', $textArea->getHtml(['id' => 'baz', 'readonly' => true, 'rows' => 10]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $textArea = new TextArea('foo');

        self::assertTrue($textArea->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $textArea = new TextArea('foo', 'bar');
        $textArea->setRequired(false);

        self::assertFalse($textArea->isRequired());
        self::assertSame('<textarea name="foo">bar</textarea>', $textArea->getHtml());
        self::assertSame('<textarea name="foo">bar</textarea>', $textArea->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $textArea = new TextArea('foo');
        $textArea->setRequired(0);
    }

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $textArea = new TextArea('foo');
        $textArea->setFormValue("Foo\0\tBar\r\nBaz");

        self::assertSame("FooBar\r\nBaz", $textArea->getValue());
        self::assertSame("<textarea name=\"foo\" required>FooBar\r\nBaz</textarea>", $textArea->__toString());
    }
}
