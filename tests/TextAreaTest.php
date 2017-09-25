<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\TextArea;
use BlueMvc\Forms\TextFormatOption;

/**
 * Test TextArea class.
 */
class TextAreaTest extends \PHPUnit_Framework_TestCase
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
     */
    public function testSetFormValue()
    {
        $textArea = new TextArea('foo');
        $textArea->setFormValue('bar');

        self::assertSame('bar', $textArea->getValue());
        self::assertSame('<textarea name="foo" required>bar</textarea>', $textArea->getHtml());
        self::assertSame('<textarea name="foo" required>bar</textarea>', $textArea->__toString());
        self::assertFalse($textArea->hasError());
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
            ['', TextFormatOption::NONE, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOption::TRIM, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOption::COMPACT, '', '<textarea name="foo" required></textarea>'],
            ['', TextFormatOption::TRIM | TextFormatOption::COMPACT, '', '<textarea name="foo" required></textarea>'],
            [' ', null, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOption::NONE, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOption::TRIM, '', '<textarea name="foo" required></textarea>'],
            [' ', TextFormatOption::COMPACT, ' ', '<textarea name="foo" required> </textarea>'],
            [' ', TextFormatOption::TRIM | TextFormatOption::COMPACT, '', '<textarea name="foo" required></textarea>'],
            ['Foo Bar', null, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOption::NONE, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOption::TRIM, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOption::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['Foo Bar', TextFormatOption::TRIM | TextFormatOption::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', null, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOption::NONE, '  Foo  Bar  ', '<textarea name="foo" required>  Foo  Bar  </textarea>'],
            ['  Foo  Bar  ', TextFormatOption::TRIM, 'Foo  Bar', '<textarea name="foo" required>Foo  Bar</textarea>'],
            ['  Foo  Bar  ', TextFormatOption::COMPACT, ' Foo Bar ', '<textarea name="foo" required> Foo Bar </textarea>'],
            ['  Foo  Bar  ', TextFormatOption::TRIM | TextFormatOption::COMPACT, 'Foo Bar', '<textarea name="foo" required>Foo Bar</textarea>'],
            ["  Foo  Bar  \r\n  Baz  ", null, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOption::NONE, "  Foo  Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo  Bar  \r\n  Baz  </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOption::TRIM, "Foo  Bar\r\nBaz", "<textarea name=\"foo\" required>Foo  Bar\r\nBaz</textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOption::COMPACT, " Foo Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo Bar \r\n Baz </textarea>"],
            ["  Foo  Bar  \r\n  Baz  ", TextFormatOption::TRIM | TextFormatOption::COMPACT, "Foo Bar\r\nBaz", "<textarea name=\"foo\" required>Foo Bar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", null, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOption::NONE, "  Foo \r\n Bar  \r\n  Baz  ", "<textarea name=\"foo\" required>  Foo \r\n Bar  \r\n  Baz  </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOption::TRIM, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOption::COMPACT, " Foo \r\n Bar \r\n Baz ", "<textarea name=\"foo\" required> Foo \r\n Bar \r\n Baz </textarea>"],
            ["  Foo \n Bar  \r  Baz  ", TextFormatOption::TRIM | TextFormatOption::COMPACT, "Foo\r\nBar\r\nBaz", "<textarea name=\"foo\" required>Foo\r\nBar\r\nBaz</textarea>"],
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
}
