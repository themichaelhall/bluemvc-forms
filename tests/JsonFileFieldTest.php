<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Core\UploadedFile;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\JsonFileField;
use DataTypes\FilePath;
use PHPUnit\Framework\TestCase;

/**
 * Test JsonFileField class.
 */
class JsonFileFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertSame('<input type="file" name="foo" required>', $jsonFileField->getHtml());
        self::assertSame('<input type="file" name="foo" required>', $jsonFileField->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertSame('foo', $jsonFileField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertNull($jsonFileField->getFile());
    }

    /**
     * Test setUploadedFile method.
     *
     * @dataProvider setUploadedFileDataProvider
     *
     * @param bool                       $isRequired       True of value is required, false otherwise.
     * @param UploadedFileInterface|null $uploadedFile     The uploaded file or null if no uploaded file.
     * @param UploadedFileInterface|null $expectedValue    The expected value or null if no value.
     * @param array                      $expectedJson     The expected json content.
     * @param string                     $expectedHtml     The expected html.
     * @param bool                       $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool                       $expectedHasError The expected value from hasError method.
     * @param string|null                $expectedError    The expected error or null if no error.
     */
    public function testSetUploadedFile(bool $isRequired, ?UploadedFileInterface $uploadedFile, ?UploadedFileInterface $expectedValue, array $expectedJson, string $expectedHtml, bool $expectedIsEmpty, $expectedHasError, $expectedError)
    {
        $jsonFileField = new JsonFileField('foo');
        $jsonFileField->setRequired($isRequired);
        $jsonFileField->setUploadedFile($uploadedFile);

        self::assertSame($uploadedFile, $expectedValue);
        self::assertSame($uploadedFile, $jsonFileField->getFile());
        self::assertSame($expectedJson, $jsonFileField->getJson());
        self::assertSame($expectedHtml, $jsonFileField->getHtml());
        self::assertSame($expectedHtml, $jsonFileField->__toString());
        self::assertSame($expectedIsEmpty, $jsonFileField->isEmpty());
        self::assertSame($expectedHasError, $jsonFileField->hasError());
        self::assertSame($expectedError, $jsonFileField->getError());
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

        $jsonFile = new UploadedFile(
            FilePath::parse(__DIR__ . '/Helpers/TestFiles/file.json'),
            'File.json',
            14
        );

        return [
            [false, null, null, [], '<input type="file" name="foo">', true, false, null],
            [true, null, null, [], '<input type="file" name="foo" required>', true, true, 'Missing file'],
            [false, $textFile, $textFile, [], '<input type="file" name="foo">', false, true, 'Invalid json content.'],
            [true, $textFile, $textFile, [], '<input type="file" name="foo" required>', false, true, 'Invalid json content.'],
            [false, $jsonFile, $jsonFile, ['Foo' => 'Bar'], '<input type="file" name="foo">', false, false, null],
            [true, $jsonFile, $jsonFile, ['Foo' => 'Bar'], '<input type="file" name="foo" required>', false, false, null],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $jsonFileField = new JsonFileField('<p>');

        self::assertSame('<input type="file" name="&lt;p&gt;" required>', $jsonFileField->getHtml());
        self::assertSame('<input type="file" name="&lt;p&gt;" required>', $jsonFileField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertTrue($jsonFileField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertFalse($jsonFileField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertNull($jsonFileField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $jsonFileField = new JsonFileField('foo');
        $jsonFileField->setError('My Error');

        self::assertTrue($jsonFileField->hasError());
        self::assertSame('My Error', $jsonFileField->getError());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertSame('<input type="file" name="foo" required id="bar" class="baz">', $jsonFileField->getHtml(['id' => 'bar', 'class' => 'baz']));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertTrue($jsonFileField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $jsonFileField = new JsonFileField('foo');
        $jsonFileField->setRequired(false);

        self::assertFalse($jsonFileField->isRequired());
        self::assertSame('<input type="file" name="foo">', $jsonFileField->getHtml());
        self::assertSame('<input type="file" name="foo">', $jsonFileField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertSame('', $jsonFileField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $jsonFileField = new JsonFileField('foo');
        $jsonFileField->setLabel('My label');

        self::assertSame('My label', $jsonFileField->getLabel());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $jsonFileField = new JsonFileField('foo');

        self::assertNull($jsonFileField->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $jsonFileField = new JsonFileField('foo');
        $jsonFileField->setCustomData([1, 2, 3]);

        self::assertSame([1, 2, 3], $jsonFileField->getCustomData());
    }
}
