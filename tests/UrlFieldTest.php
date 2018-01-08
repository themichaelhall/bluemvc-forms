<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\UrlField;
use DataTypes\Url;
use PHPUnit\Framework\TestCase;

/**
 * Test UrlField class.
 */
class UrlFieldTest extends TestCase
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
        $urlField = new UrlField('foo');
        $urlField->setRequired($isRequired);
        $urlField->setFormValue($value);

        self::assertSame($expectedValue, $urlField->getValue() !== null ? $urlField->getValue()->__toString() : null);
        self::assertSame($expectedIsEmpty, $urlField->isEmpty());
        self::assertSame($expectedIsInvalid, $urlField->isInvalid());
        self::assertSame($expectedHasError, $urlField->hasError());
        self::assertSame($expectedError, $urlField->getError());
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
            [false, 'http://example.com/', 'http://example.com/', false, false, false, null],
            [true, 'http://example.com/', 'http://example.com/', false, false, false, null],
            [false, ' http://example.com/ ', 'http://example.com/', false, false, false, null],
            [true, ' http://example.com/ ', 'http://example.com/', false, false, false, null],
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
        $urlField = new UrlField('foo');
        $urlField->setFormValue(true);
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
        $urlField = new UrlField('foo');
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
            ['', null, '<input type="url" name="foo" required>'],
            [' ', null, '<input type="url" name="foo" required>'],
            ['Foo Bar', null, '<input type="url" name="foo" value="Foo Bar" required>'],
            ['  Foo  Bar  ', null, '<input type="url" name="foo" value="Foo  Bar" required>'],
            ['https://example.com/', 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
            ['  https://example.com/  ', 'https://example.com/', '<input type="url" name="foo" value="https://example.com/" required>'],
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
        $urlField = new UrlField('foo', Url::parse('https://localhost:8080/'));

        self::assertFalse($urlField->isEmpty());
    }

    /**
     * Test isInvalid method for empty value.
     */
    public function testIsValidForEmptyValue()
    {
        $urlField = new UrlField('foo');

        self::assertFalse($urlField->isInvalid());
    }

    /**
     * Test isInvalid method for non-empty value.
     */
    public function testIsValidForNonEmptyValue()
    {
        $urlField = new UrlField('foo', Url::parse('https://localhost:8080/'));

        self::assertFalse($urlField->isInvalid());
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

    /**
     * Test text sanitization.
     */
    public function testTextSanitization()
    {
        $urlField = new UrlField('foo');
        $urlField->setFormValue("https://\0\twww.\r\nexample.com");

        self::assertSame('https://www.example.com/', $urlField->getValue()->__toString());
        self::assertSame('<input type="url" name="foo" value="https://www.example.com" required>', $urlField->__toString());
    }
}
