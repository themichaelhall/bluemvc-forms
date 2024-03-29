<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Forms\PasswordField;
use PHPUnit\Framework\TestCase;

/**
 * Test PasswordField class.
 */
class PasswordFieldTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('<input type="password" name="foo" required>', $passwordField->getHtml());
        self::assertSame('<input type="password" name="foo" required>', $passwordField->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('foo', $passwordField->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('', $passwordField->getValue());
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
        $passwordField = new PasswordField('foo');
        $passwordField->setRequired($isRequired);
        $passwordField->setFormValue($value);

        self::assertSame($expectedValue, $passwordField->getValue());
        self::assertSame($expectedIsEmpty, $passwordField->isEmpty());
        self::assertSame($expectedHasError, $passwordField->hasError());
        self::assertSame($expectedError, $passwordField->getError());
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
            [false, ' ', ' ', false, false, null],
            [true, ' ', ' ', false, false, null],
            [false, 'FooBar', 'FooBar', false, false, null],
            [true, 'FooBar', 'FooBar', false, false, null],
            [false, ' Foo  Bar Baz ', ' Foo  Bar Baz ', false, false, null],
            [true, ' Foo  Bar Baz ', ' Foo  Bar Baz ', false, false, null],
        ];
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
    public function testTextFormatting(string $value, string $expectedValue, string $expectedHtmlString)
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue($value);

        self::assertSame($expectedValue, $passwordField->getValue());
        self::assertSame($expectedHtmlString, $passwordField->getHtml());
        self::assertSame($expectedHtmlString, $passwordField->__toString());
    }

    /**
     * Data provider for testTextFormatting method.
     *
     * @return array The data.
     */
    public function textFormattingDataProvider(): array
    {
        return [
            ['', '', '<input type="password" name="foo" required>'],
            [' ', ' ', '<input type="password" name="foo" required>'],
            ['Foo Bar', 'Foo Bar', '<input type="password" name="foo" required>'],
            ['  Foo  Bar  ', '  Foo  Bar  ', '<input type="password" name="foo" required>'],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $passwordField = new PasswordField('<p>');

        self::assertSame('<input type="password" name="&lt;p&gt;" required>', $passwordField->getHtml());
        self::assertSame('<input type="password" name="&lt;p&gt;" required>', $passwordField->__toString());
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $passwordField = new PasswordField('foo');

        self::assertTrue($passwordField->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue('bar');

        self::assertFalse($passwordField->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $passwordField = new PasswordField('foo');

        self::assertFalse($passwordField->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $passwordField = new PasswordField('foo');

        self::assertNull($passwordField->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setError('My Error');

        self::assertTrue($passwordField->hasError());
        self::assertSame('My Error', $passwordField->getError());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('<input type="password" name="foo" required id="baz" readonly>', $passwordField->getHtml(['id' => 'baz', 'readonly' => true]));
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $passwordField = new PasswordField('foo');

        self::assertTrue($passwordField->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setRequired(false);

        self::assertFalse($passwordField->isRequired());
        self::assertSame('<input type="password" name="foo">', $passwordField->getHtml());
        self::assertSame('<input type="password" name="foo">', $passwordField->__toString());
    }

    /**
     * Test text sanitation.
     */
    public function testTextSanitation()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue("Foo\0\tBar\r\nBaz");

        self::assertSame('FooBarBaz', $passwordField->getValue());
        self::assertSame('<input type="password" name="foo" required>', $passwordField->__toString());
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $passwordField = new PasswordField('foo');

        self::assertSame('', $passwordField->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setLabel('My label');

        self::assertSame('My label', $passwordField->getLabel());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $passwordField = new PasswordField('foo');

        self::assertFalse($passwordField->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setDisabled(true);

        self::assertTrue($passwordField->isDisabled());
        self::assertSame('<input type="password" name="foo" required disabled>', $passwordField->getHtml());
        self::assertSame('<input type="password" name="foo" required disabled>', $passwordField->__toString());
    }

    /**
     * Test getCustomItem method.
     */
    public function testGetCustomItem()
    {
        $passwordField = new PasswordField('foo');

        self::assertNull($passwordField->getCustomItem('Foo'));
        self::assertNull($passwordField->getCustomItem('Bar'));
        self::assertNull($passwordField->getCustomItem('Baz'));
    }

    /**
     * Test setCustomItem method.
     */
    public function testSetCustomItem()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setCustomItem('Foo', 1234);
        $passwordField->setCustomItem('Bar', true);

        self::assertSame(1234, $passwordField->getCustomItem('Foo'));
        self::assertTrue($passwordField->getCustomItem('Bar'));
        self::assertNull($passwordField->getCustomItem('Baz'));
    }

    /**
     * Test getCustomItems method.
     */
    public function testGetCustomItems()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setCustomItem('Bar', 0.0);
        $passwordField->setCustomItem('Baz', 'Foo');

        self::assertSame(['Bar' => 0.0, 'Baz' => 'Foo'], iterator_to_array($passwordField->getCustomItems()));
    }

    /**
     * Test setCustomItems method.
     */
    public function testSetCustomItems()
    {
        $customItemCollection = new CustomItemCollection();
        $customItemCollection->set('Foo', [1, 2]);
        $customItemCollection->set('Baz', false);

        $passwordField = new PasswordField('foo');
        $passwordField->setCustomItems($customItemCollection);

        self::assertSame([1, 2], $passwordField->getCustomItem('Foo'));
        self::assertNull($passwordField->getCustomItem('Bar'));
        self::assertFalse($passwordField->getCustomItem('Baz'));
    }

    /**
     * Test set an invalid text.
     */
    public function testSetInvalidText()
    {
        $passwordField = new PasswordField('foo');
        $passwordField->setFormValue('Foo' . chr(128));

        self::assertSame('', $passwordField->getValue());
    }
}
