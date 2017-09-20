<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\FileField;

/**
 * Test FileField class.
 */
class FileFieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $fileField = new FileField('foo');

        self::assertSame('<input type="file" name="foo" required>', $fileField->getHtml());
        self::assertSame('<input type="file" name="foo" required>', $fileField->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new FileField(null);
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $fileField = new FileField('foo');

        self::assertSame('foo', $fileField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $fileField = new FileField('foo');

        self::assertNull(null, $fileField->getValue());
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $fileField = new FileField('<p>');

        self::assertSame('<input type="file" name="&lt;p&gt;" required>', $fileField->getHtml());
        self::assertSame('<input type="file" name="&lt;p&gt;" required>', $fileField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $fileField = new FileField('foo');

        self::assertTrue($fileField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $fileField = new FileField('foo');

        self::assertFalse($fileField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $fileField = new FileField('foo');

        self::assertNull($fileField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $fileField = new FileField('foo');
        $fileField->setError('My Error');

        self::assertTrue($fileField->hasError());
        self::assertSame('My Error', $fileField->getError());
    }

    /**
     * Test setError method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $error parameter is not a string.
     */
    public function testSetErrorWithInvalidParameterType()
    {
        $fileField = new FileField('foo');
        $fileField->setError(true);
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $fileField = new FileField('foo');

        self::assertSame('<input type="file" name="foo" required id="bar" class="baz">', $fileField->getHtml(['id' => 'bar', 'class' => 'baz']));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $fileField = new FileField('foo');

        self::assertTrue($fileField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $fileField = new FileField('foo');
        $fileField->setRequired(false);

        self::assertFalse($fileField->isRequired());
        self::assertSame('<input type="file" name="foo">', $fileField->getHtml());
        self::assertSame('<input type="file" name="foo">', $fileField->__toString());
    }

    /**
     * Test setRequired method with invalid parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $isRequired parameter is not a boolean.
     */
    public function testSetRequiredWithInvalidParameterType()
    {
        $fileField = new FileField('foo');
        $fileField->setRequired(-10);
    }

    /**
     * Test isValid method.
     */
    public function testIsValid()
    {
        $fileField = new FileField('foo');

        self::assertTrue($fileField->isValid());
    }
}
