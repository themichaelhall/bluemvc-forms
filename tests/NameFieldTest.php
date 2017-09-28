<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Tests\Helpers\TestFormElements\NameField;
use BlueMvc\Forms\TextFormatOptions;

/**
 * Test NameField class.
 */
class NameFieldTest extends \PHPUnit_Framework_TestCase
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
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new NameField(0);
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
     * @param string|null $expectedValue    The expected value or null if no value.
     * @param bool        $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool        $expectedHasError The expected value from hasError method.
     * @param string|null $expectedError    The expected error or null if no error.
     */
    public function testSetFormValue($isRequired, $value, $expectedValue, $expectedIsEmpty, $expectedHasError, $expectedError)
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
     * Test setFormValue method with invalid value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testSetFormValueWithInvalidValueParameterType()
    {
        $nameField = new NameField('foo');
        $nameField->setFormValue(true);
    }

    /**
     * Test constructor with invalid text format options parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $textFormatOptions parameter is not an integer.
     */
    public function testConstructorWithInvalidTextFormatOptionsParameterType()
    {
        new NameField('foo', '', false);
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
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $nameField = new NameField('foo');
        $nameField->setError(1.2);
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
     * Test constructor with default value with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithDefaultValueWithInvalidParameterType()
    {
        new NameField('foo', false);
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
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $nameField = new NameField('foo');
        $nameField->setRequired(0);
    }
}
