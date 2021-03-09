<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\CustomValidatedField;
use BlueMvc\Forms\TextFormatOptions;
use PHPUnit\Framework\TestCase;

/**
 * Class Test CustomValidatedField class.
 */
class CustomValidatedFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertSame('<input type="text" name="foo" required>', $customValidatedField->getHtml());
        self::assertSame('<input type="text" name="foo" required>', $customValidatedField->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertSame('foo', $customValidatedField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertSame('', $customValidatedField->getValue());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired       True of value is required, false otherwise.
     * @param string      $value            The value.
     * @param string      $expectedValue    The expected value.
     * @param bool        $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool        $expectedHasError The expected value from hasError method.
     * @param string|null $expectedError    The expected error or null if no error.
     */
    public function testSetFormValue(bool $isRequired, string $value, string $expectedValue, bool $expectedIsEmpty, bool $expectedHasError, ?string $expectedError)
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setRequired($isRequired);
        $customValidatedField->setFormValue($value);

        self::assertSame($expectedValue, $customValidatedField->getValue());
        self::assertSame($expectedIsEmpty, $customValidatedField->isEmpty());
        self::assertSame($expectedHasError, $customValidatedField->hasError());
        self::assertSame($expectedError, $customValidatedField->getError());
    }

    /**
     * Data provider for testSetFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider(): array
    {
        return [
            [false, '', '', true, false, null],
            [true, '', '', true, true, 'Missing value'],
            [false, ' ', '', true, false, null],
            [true, ' ', '', true, true, 'Missing value'],
            [false, 'FooBar', 'FooBar', false, false, null],
            [true, 'FooBar', 'FooBar', false, false, null],
            [false, ' Foo  Bar Baz ', 'Foo Bar Baz', false, false, null],
            [true, ' Foo  Bar Baz ', 'Foo Bar Baz', false, false, null],
            [false, 'invalid', 'invalid', false, true, 'Value of custom validated field is invalid.'],
            [true, 'invalid', 'invalid', false, true, 'Value of custom validated field is invalid.'],
            [false, ' invalid ', 'invalid', false, true, 'Value of custom validated field is invalid.'],
            [true, ' invalid ', 'invalid', false, true, 'Value of custom validated field is invalid.'],
        ];
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
    public function testTextFormatting(string $value, ?int $textFormatOptions, string $expectedValue, string $expectedHtmlString)
    {
        $customValidatedField = $textFormatOptions !== null ?
            new CustomValidatedField('foo', '', $textFormatOptions) :
            new CustomValidatedField('foo');
        $customValidatedField->setFormValue($value);

        self::assertSame($expectedValue, $customValidatedField->getValue());
        self::assertSame($expectedHtmlString, $customValidatedField->getHtml());
        self::assertSame($expectedHtmlString, $customValidatedField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider(): array
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
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $customValidatedField = new CustomValidatedField('<p>');
        $customValidatedField->setFormValue('<em>');

        self::assertSame('<input type="text" name="&lt;p&gt;" value="&lt;em&gt;" required>', $customValidatedField->getHtml());
        self::assertSame('<input type="text" name="&lt;p&gt;" value="&lt;em&gt;" required>', $customValidatedField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertTrue($customValidatedField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setFormValue('bar');

        self::assertFalse($customValidatedField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertFalse($customValidatedField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertNull($customValidatedField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setError('My Error');

        self::assertTrue($customValidatedField->hasError());
        self::assertSame('My Error', $customValidatedField->getError());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $customValidatedField = new CustomValidatedField('foo', 'bar');

        self::assertSame('bar', $customValidatedField->getValue());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $customValidatedField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $customValidatedField->__toString());
    }

    /**
     * Test that value is formatted in constructor.
     */
    public function testValueIsFormattedInConstructor()
    {
        $customValidatedField = new CustomValidatedField('foo', ' bar ');

        self::assertSame('<input type="text" name="foo" value="bar" required>', $customValidatedField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar" required>', $customValidatedField->__toString());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $customValidatedField = new CustomValidatedField('foo', 'bar');

        self::assertSame('<input type="text" name="foo" value="bar" required id="baz" readonly>', $customValidatedField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertTrue($customValidatedField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $customValidatedField = new CustomValidatedField('foo', 'bar');
        $customValidatedField->setRequired(false);

        self::assertFalse($customValidatedField->isRequired());
        self::assertSame('<input type="text" name="foo" value="bar">', $customValidatedField->getHtml());
        self::assertSame('<input type="text" name="foo" value="bar">', $customValidatedField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertSame('', $customValidatedField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setLabel('My label');

        self::assertSame('My label', $customValidatedField->getLabel());
    }

    /**
     * Test getCustomData method.
     *
     * @noinspection PhpDeprecationInspection
     */
    public function testGetCustomData()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertNull($customValidatedField->getCustomData());
    }

    /**
     * Test setCustomData method.
     *
     * @noinspection PhpDeprecationInspection
     */
    public function testSetCustomData()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setCustomData(['Foo Bar']);

        self::assertSame(['Foo Bar'], $customValidatedField->getCustomData());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertFalse($customValidatedField->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setDisabled(true);

        self::assertTrue($customValidatedField->isDisabled());
        self::assertSame('<input type="text" name="foo" required disabled>', $customValidatedField->getHtml());
        self::assertSame('<input type="text" name="foo" required disabled>', $customValidatedField->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $customValidatedField = new CustomValidatedField('foo');

        self::assertNull($customValidatedField->getCustomItem('Foo'));
        self::assertNull($customValidatedField->getCustomItem('Bar'));
        self::assertNull($customValidatedField->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setCustomItem('Foo', 1234);
        $customValidatedField->setCustomItem('Bar', true);

        self::assertSame(1234, $customValidatedField->getCustomItem('Foo'));
        self::assertTrue($customValidatedField->getCustomItem('Bar'));
        self::assertNull($customValidatedField->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setCustomItem('Bar', 0.0);
        $customValidatedField->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($customValidatedField->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $customValidatedField = new CustomValidatedField('foo');
        $customValidatedField->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $customValidatedField->getCustomItem('Foo'));
        self::assertNull($customValidatedField->getCustomItem('Bar'));
        self::assertFalse($customValidatedField->getCustomItem('Baz'));
    }
}
