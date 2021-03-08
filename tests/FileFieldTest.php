<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
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

        self::assertNull($fileField->getFile());
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
    public function testSetUploadedFile(bool $isRequired, ?UploadedFileInterface $uploadedFile, ?UploadedFileInterface $expectedValue, string $expectedHtml, bool $expectedIsEmpty, bool $expectedHasError, ?string $expectedError)
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
    public function setUploadedFileDataProvider(): array
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
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $fileField = new FileField('foo');

        self::assertSame('', $fileField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $fileField = new FileField('foo');
        $fileField->setLabel('My label');

        self::assertSame('My label', $fileField->getLabel());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $fileField = new FileField('foo');

        self::assertNull($fileField->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $fileField = new FileField('foo');
        $fileField->setCustomData(false);

        self::assertFalse($fileField->getCustomData());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $fileField = new FileField('foo');

        self::assertFalse($fileField->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $fileField = new FileField('foo');
        $fileField->setDisabled(true);

        self::assertTrue($fileField->isDisabled());
        self::assertSame('<input type="file" name="foo" required disabled>', $fileField->getHtml());
        self::assertSame('<input type="file" name="foo" required disabled>', $fileField->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $fileField = new FileField('foo');

        self::assertNull($fileField->getCustomItem('Foo'));
        self::assertNull($fileField->getCustomItem('Bar'));
        self::assertNull($fileField->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $fileField = new FileField('foo');
        $fileField->setCustomItem('Foo', 1234);
        $fileField->setCustomItem('Bar', true);

        self::assertSame(1234, $fileField->getCustomItem('Foo'));
        self::assertTrue($fileField->getCustomItem('Bar'));
        self::assertNull($fileField->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $fileField = new FileField('foo');
        $fileField->setCustomItem('Bar', 0.0);
        $fileField->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($fileField->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $fileField = new FileField('foo');
        $fileField->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $fileField->getCustomItem('Foo'));
        self::assertNull($fileField->getCustomItem('Bar'));
        self::assertFalse($fileField->getCustomItem('Baz'));
    }
}
