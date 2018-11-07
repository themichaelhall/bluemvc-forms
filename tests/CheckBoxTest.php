<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\CheckBox;
use PHPUnit\Framework\TestCase;

/**
 * Test CheckBox class.
 */
class CheckBoxTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $checkbox = new CheckBox('foo');

        self::assertSame('<input type="checkbox" name="foo" required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" required>', $checkbox->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $checkbox = new CheckBox('foo');

        self::assertSame('foo', $checkbox->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $checkbox = new CheckBox('foo');

        self::assertFalse($checkbox->getValue());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired       True of value is required, false otherwise.
     * @param string      $value            The value.
     * @param bool        $expectedValue    The expected value.
     * @param string      $expectedHtml     The expected html.
     * @param bool        $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool        $expectedHasError The expected value from hasError method.
     * @param string|null $expectedError    The expected error or null if no error.
     */
    public function testSetFormValue(bool $isRequired, string $value, bool $expectedValue, string $expectedHtml, bool $expectedIsEmpty, bool $expectedHasError, ?string $expectedError)
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setRequired($isRequired);
        $checkbox->setFormValue($value);

        self::assertSame($expectedValue, $checkbox->getValue());
        self::assertSame($expectedHtml, $checkbox->getHtml());
        self::assertSame($expectedHtml, $checkbox->__toString());
        self::assertSame($expectedIsEmpty, $checkbox->isEmpty());
        self::assertSame($expectedHasError, $checkbox->hasError());
        self::assertSame($expectedError, $checkbox->getError());
    }

    /**
     * Data provider for setFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider()
    {
        return [
            [false, '', false, '<input type="checkbox" name="foo">', true, false, null],
            [true, '', false, '<input type="checkbox" name="foo" required>', true, true, 'Missing value'],
            [false, 'on', true, '<input type="checkbox" name="foo" checked>', false, false, null],
            [true, 'on', true, '<input type="checkbox" name="foo" checked required>', false, false, null],
            [false, 'foo', false, '<input type="checkbox" name="foo">', true, false, null],
            [true, 'foo', false, '<input type="checkbox" name="foo" required>', true, true, 'Missing value'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $checkbox = new CheckBox('<p>');

        self::assertSame('<input type="checkbox" name="&lt;p&gt;" required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="&lt;p&gt;" required>', $checkbox->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $checkbox = new CheckBox('foo');

        self::assertTrue($checkbox->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setFormValue('on');

        self::assertFalse($checkbox->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $checkbox = new CheckBox('foo');

        self::assertFalse($checkbox->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $checkbox = new CheckBox('foo');

        self::assertNull($checkbox->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setError('My Error');

        self::assertTrue($checkbox->hasError());
        self::assertSame('My Error', $checkbox->getError());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $checkbox = new CheckBox('foo', true);

        self::assertTrue($checkbox->getValue());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" checked required>', $checkbox->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $checkbox = new CheckBox('foo', true);

        self::assertSame('<input type="checkbox" name="foo" checked required id="baz" readonly>', $checkbox->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $checkbox = new CheckBox('foo');

        self::assertTrue($checkbox->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $checkbox = new CheckBox('foo', true);
        $checkbox->setRequired(false);

        self::assertFalse($checkbox->isRequired());
        self::assertSame('<input type="checkbox" name="foo" checked>', $checkbox->getHtml());
        self::assertSame('<input type="checkbox" name="foo" checked>', $checkbox->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $checkbox = new CheckBox('foo');

        self::assertSame('', $checkbox->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $checkbox = new CheckBox('foo');
        $checkbox->setLabel('My label');

        self::assertSame('My label', $checkbox->getLabel());
    }
}
