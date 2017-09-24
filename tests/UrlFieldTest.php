<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\TextFormatOption;
use BlueMvc\Forms\UrlField;
use DataTypes\Url;

/**
 * Test UrlField class.
 */
class UrlFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $urlField = new UrlField('foo');

        self::assertSame('<input type="url" name="foo" required>', $urlField->getHtml());
        self::assertSame('<input type="url" name="foo" required>', $urlField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new UrlField(0);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $urlField = new UrlField('foo');

        self::assertSame('foo', $urlField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $urlField = new UrlField('foo');

        self::assertNull(null, $urlField->getValue());
    }

    /**
     * Test setFormValue method.
     */
    public function testSetFormValue()
    {
        $urlField = new UrlField('foo');
        $urlField->setFormValue('https://domain.com/');

        self::assertSame('https://domain.com/', $urlField->getValue()->__toString());
        self::assertSame('<input type="url" name="foo" value="https://domain.com/" required>', $urlField->getHtml());
        self::assertSame('<input type="url" name="foo" value="https://domain.com/" required>', $urlField->__toString());
        self::assertFalse($urlField->hasError());
    }

    /**
     * Test setFormValue method with invalid url.
     */
    public function testSetFormValueWithInvalidUrl()
    {
        $urlField = new UrlField('foo');
        $urlField->setFormValue('FooBar');

        self::assertNull($urlField->getValue());
        self::assertSame('<input type="url" name="foo" value="FooBar" required>', $urlField->getHtml());
        self::assertSame('<input type="url" name="foo" value="FooBar" required>', $urlField->__toString());
        self::assertTrue($urlField->hasError());
        self::assertSame('Invalid value', $urlField->getError());
    }

    /**
     * Test setFormValue method with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testSetFormValueWithInvalidValueParameterType()
    {
        $urlField = new UrlField('foo');
        $urlField->setFormValue(true);
    }

    /**
     * Test getFormatTextOptions method with default value.
     */
    public function testGetFormatTextOptions()
    {
        $urlField = new UrlField('foo');

        self::assertSame(TextFormatOption::TRIM, $urlField->getTextFormatOptions());
    }

    /**
     * Test setFormatTextOptions method.
     */
    public function testSetFormatTextOptions()
    {
        $urlField = new UrlField('foo');
        $urlField->setTextFormatOptions(TextFormatOption::NONE);

        self::assertSame(TextFormatOption::NONE, $urlField->getTextFormatOptions());
    }

    /**
     * Test setFormatTextOptions method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $textFormatOptions parameter is not an integer.
     */
    public function testSetFormatTextOptionsWithInvalidParameterType()
    {
        $urlField = new UrlField('foo');
        $urlField->setTextFormatOptions(false);
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
        $urlField = new UrlField('foo');
        if ($textFormatOptions !== null) {
            $urlField->setTextFormatOptions($textFormatOptions);
        }
        $urlField->setFormValue($value);

        self::assertSame($expectedValue, $urlField->getValue() !== null ? $urlField->getValue()->__toString() : null);
        self::assertSame($expectedHtmlString, $urlField->getHtml());
        self::assertSame($expectedHtmlString, $urlField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider()
    {
        return [
            ['', null, null, '<input type="url" name="foo" required>'],
            ['', TextFormatOption::NONE, null, '<input type="url" name="foo" required>'],
            ['', TextFormatOption::TRIM, null, '<input type="url" name="foo" required>'],
            [' ', null, null, '<input type="url" name="foo" required>'],
            [' ', TextFormatOption::NONE, null, '<input type="url" name="foo" value=" " required>'],
            [' ', TextFormatOption::TRIM, null, '<input type="url" name="foo" required>'],
            ['Foo Bar', null, null, '<input type="url" name="foo" value="Foo Bar" required>'],
            ['Foo Bar', TextFormatOption::NONE, null, '<input type="url" name="foo" value="Foo Bar" required>'],
            ['Foo Bar', TextFormatOption::TRIM, null, '<input type="url" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', null, null, '<input type="url" name="foo" value="Foo  Bar" required>'],
            ['  Foo  Bar  ', TextFormatOption::NONE, null, '<input type="url" name="foo" value="  Foo  Bar  " required>'],
            ['  Foo  Bar  ', TextFormatOption::TRIM, null, '<input type="url" name="foo" value="Foo  Bar" required>'],
            ['https://example.com/', null, 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
            ['https://example.com/', TextFormatOption::NONE, 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
            ['https://example.com/', TextFormatOption::TRIM, 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
            ['  https://example.com/  ', null, 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
            ['  https://example.com/  ', TextFormatOption::NONE, 'https://example.com/', '<input type="url" name="foo" value="  https://example.com/  " required>'],
            ['  https://example.com/  ', TextFormatOption::TRIM, 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $urlField = new UrlField('<p>');
        $urlField->setFormValue('<em>');

        self::assertSame('<input type="url" name="&lt;p&gt;" value="&lt;em&gt;" required>', $urlField->getHtml());
        self::assertSame('<input type="url" name="&lt;p&gt;" value="&lt;em&gt;" required>', $urlField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $urlField = new UrlField('foo');

        self::assertTrue($urlField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $urlField = new UrlField('foo');
        $urlField->setFormValue('https://localhost:8080/');

        self::assertFalse($urlField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $urlField = new UrlField('foo');

        self::assertFalse($urlField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $urlField = new UrlField('foo');

        self::assertNull($urlField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $urlField = new UrlField('foo');
        $urlField->setError('My Error');

        self::assertTrue($urlField->hasError());
        self::assertSame('My Error', $urlField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $urlField = new UrlField('foo');
        $urlField->setError(1.2);
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $urlField = new UrlField('foo', Url::parse('https://domain.com/foo/bar'));

        self::assertSame('https://domain.com/foo/bar', $urlField->getValue()->__toString());
        self::assertSame('<input type="url" name="foo" value="https://domain.com/foo/bar" required>', $urlField->getHtml());
        self::assertSame('<input type="url" name="foo" value="https://domain.com/foo/bar" required>', $urlField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $urlField = new UrlField('foo', Url::parse('https://domain.com/foo/bar'));

        self::assertSame('<input type="url" name="foo" value="https://domain.com/foo/bar" required id="baz" readonly>', $urlField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $urlField = new UrlField('foo');

        self::assertTrue($urlField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $urlField = new UrlField('foo', Url::parse('https://domain.com/foo/bar'));
        $urlField->setRequired(false);

        self::assertFalse($urlField->isRequired());
        self::assertSame('<input type="url" name="foo" value="https://domain.com/foo/bar">', $urlField->getHtml());
        self::assertSame('<input type="url" name="foo" value="https://domain.com/foo/bar">', $urlField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $urlField = new UrlField('foo');
        $urlField->setRequired(0);
    }
}
