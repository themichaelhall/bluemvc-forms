<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Core\UploadedFile;
use BlueMvc\Forms\FileField;
use DataTypes\FilePath;
use PHPUnit\Framework\TestCase;

/**
 * Test FileField class.
 */
class FileFieldTest extends TestCase
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
     * Test getFile method.
     */
    public function testGetFile()
    {
        $fileField = new FileField('foo');

        self::assertNull(null, $fileField->getFile());
    }

    /**
     * Test setUploadedFile method.
     *
     * @dataProvider setUploadedFileDataProvider
     *
     * @param bool                       $isRequired       True of value is required, false otherwise.
     * @param UploadedFileInterface|null $uploadedFile     The uploaded file or null if no uploaded file.
     * @param UploadedFileInterface|null $expectedValue    The expected value or null if no value.
     * @param string                     $expectedHtml     The expected html.
     * @param bool                       $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool                       $expectedHasError The expected value from hasError method.
     * @param string|null                $expectedError    The expected error or null if no error.
     */
    public function testSetUploadedFile($isRequired, $uploadedFile, $expectedValue, $expectedHtml, $expectedIsEmpty, $expectedHasError, $expectedError)
    {
        $fileField = new FileField('foo');
        $fileField->setRequired($isRequired);
        $fileField->setUploadedFile($uploadedFile);

        self::assertSame($uploadedFile, $expectedValue);
        self::assertSame($uploadedFile, $fileField->getFile());
        self::assertSame($expectedHtml, $fileField->getHtml());
        self::assertSame($expectedHtml, $fileField->__toString());
        self::assertSame($expectedIsEmpty, $fileField->isEmpty());
        self::assertSame($expectedHasError, $fileField->hasError());
        self::assertSame($expectedError, $fileField->getError());
    }

    /**
     * Data provider for testSetUploadedFile method.
     *
     * @return array The data.
     */
    public function setUploadedFileDataProvider()
    {
        $textFile = new UploadedFile(
            FilePath::parse(__DIR__ . '/Helpers/TestFiles/file.txt'),
            'File.txt',
            16
        );

        return [
            [false, null, null, '<input type="file" name="foo">', true, false, null],
            [true, null, null, '<input type="file" name="foo" required>', true, true, 'Missing file'],
            [false, $textFile, $textFile, '<input type="file" name="foo">', false, false, null],
            [true, $textFile, $textFile, '<input type="file" name="foo" required>', false, false, null],
        ];
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
}
