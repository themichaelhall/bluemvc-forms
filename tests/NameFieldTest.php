<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Tests\Helpers\TestFormElements\NameField;

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
     */
    public function testSetFormValue()
    {
        $nameField = new NameField('foo');
        $nameField->setFormValue('bar');

        self::assertSame('Bar', $nameField->getValue());
        self::assertSame('<input type="text" name="foo" value="Bar" required>', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" value="Bar" required>', $nameField->__toString());
    }

    /**
     * Test that setFormValue method formats the input.
     */
    public function testSetFormValueFormatsInput()
    {
        $nameField = new NameField('foo');
        $nameField->setFormValue(' foo   Bar  baz ');

        self::assertSame('Foo Bar Baz', $nameField->getValue());
        self::assertSame('<input type="text" name="foo" value="Foo Bar Baz" required>', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" value="Foo Bar Baz" required>', $nameField->__toString());
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
        $nameField = new NameField('foo', 'bar');

        self::assertSame('bar', $nameField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $nameField->__toString());
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
        $nameField = new NameField('foo', 'bar');

        self::assertSame('<input type="text" name="foo" value="bar" required id="baz" readonly>', $nameField->getHtml(['id' => 'baz', 'readonly' => true]));
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
        $nameField = new NameField('foo', 'bar');
        $nameField->setRequired(false);

        self::assertFalse($nameField->isRequired());
        self::assertSame('<input type="text" name="foo" value="bar">', $nameField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar">', $nameField->__toString());
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
