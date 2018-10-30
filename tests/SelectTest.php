<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\Option;
use BlueMvc\Forms\Select;
use PHPUnit\Framework\TestCase;

/**
 * Test Select class.
 */
class SelectTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $select = new Select('foo');

        self::assertSame('<select name="foo"></select>', $select->getHtml());
        self::assertSame('<select name="foo"></select>', $select->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $select = new Select('foo');

        self::assertSame('foo', $select->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $select = new Select('foo');

        self::assertSame('', $select->getValue());
    }

    /**
     * Test addOption method.
     */
    public function testAddOption()
    {
        $select = new Select('foo');
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));

        self::assertSame('<select name="foo"><option value="1">One</option><option value="2">Two</option></select>', $select->getHtml());
        self::assertSame('<select name="foo"><option value="1">One</option><option value="2">Two</option></select>', $select->__toString());
    }

    /**
     * Test addOption method with one option selected.
     */
    public function testAddOptionWithOneOptionSelected()
    {
        $select = new Select('foo');
        $select->addOption(new Option('', 'None'));
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));

        self::assertSame('<select name="foo" required><option value="" selected>None</option><option value="1">One</option><option value="2">Two</option></select>', $select->getHtml());
        self::assertSame('<select name="foo" required><option value="" selected>None</option><option value="1">One</option><option value="2">Two</option></select>', $select->__toString());
    }

    /**
     * Test getOptions method.
     */
    public function testGetOptions()
    {
        $option1 = new Option('', 'None');
        $option2 = new Option('1', 'One');

        $select = new Select('foo');
        $select->addOption($option1);
        $select->addOption($option2);

        self::assertSame([$option1, $option2], $select->getOptions());
    }

    /**
     * Test setFormValue method.
     *
     * @dataProvider setFormValueDataProvider
     *
     * @param bool        $isRequired       True of value is required, false otherwise.
     * @param string      $value            The value.
     * @param string      $expectedValue    The expected value.
     * @param string      $expectedHtml     The expected html.
     * @param bool        $expectedIsEmpty  The expected value from isEmpty method.
     * @param bool        $expectedHasError The expected value from hasError method.
     * @param string|null $expectedError    The expected error or null if no error.
     */
    public function testSetFormValue(bool $isRequired, string $value, string $expectedValue, string $expectedHtml, bool $expectedIsEmpty, bool $expectedHasError, ?string $expectedError)
    {
        $select = new Select('foo');
        $select->setRequired($isRequired);
        $select->addOption(new Option('', 'None'));
        $select->addOption(new Option('1', 'One'));
        $select->setFormValue($value);

        self::assertSame($expectedHtml, $select->getHtml());
        self::assertSame($expectedHtml, $select->__toString());
        self::assertSame($expectedValue, $select->getValue());
        self::assertSame($expectedIsEmpty, $select->isEmpty());
        self::assertSame($expectedHasError, $select->hasError());
        self::assertSame($expectedError, $select->getError());
    }

    /**
     * Data provider for testSetFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider()
    {
        return [
            [false, '', '', '<select name="foo"><option value="" selected>None</option><option value="1">One</option></select>', true, false, null],
            [true, '', '', '<select name="foo" required><option value="" selected>None</option><option value="1">One</option></select>', true, true, 'Missing value'],
            [false, '1', '1', '<select name="foo"><option value="">None</option><option value="1" selected>One</option></select>', false, false, null],
            [true, '1', '1', '<select name="foo" required><option value="">None</option><option value="1" selected>One</option></select>', false, false, null],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $select = new Select('<p>foo</p>');
        $select->addOption(new Option('<span>1</span>', '<h1>One</h1>'));

        self::assertSame('<select name="&lt;p&gt;foo&lt;/p&gt;"><option value="&lt;span&gt;1&lt;/span&gt;">&lt;h1&gt;One&lt;/h1&gt;</option></select>', $select->getHtml());
        self::assertSame('<select name="&lt;p&gt;foo&lt;/p&gt;"><option value="&lt;span&gt;1&lt;/span&gt;">&lt;h1&gt;One&lt;/h1&gt;</option></select>', $select->__toString());
        self::assertSame('', $select->getValue());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $select = new Select('foo');
        $select->addOption(new Option('1', 'One'));

        self::assertSame('<select name="foo" class="my-select" id="s1"><option value="1">One</option></select>', $select->getHtml(['class' => 'my-select', 'id' => 's1']));
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $select = new Select('foo');
        $select->addOption(new Option('', 'None'));
        $select->addOption(new Option('1', 'One'));

        self::assertTrue($select->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $select = new Select('foo');
        $select->addOption(new Option('', 'None'));
        $select->addOption(new Option('1', 'One'));
        $select->setFormValue('1');

        self::assertFalse($select->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $select = new Select('foo');

        self::assertFalse($select->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $select = new Select('foo');

        self::assertNull($select->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $select = new Select('foo');
        $select->setError('My Error');

        self::assertTrue($select->hasError());
        self::assertSame('My Error', $select->getError());
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $select = new Select('foo');

        self::assertTrue($select->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $select = new Select('foo');
        $select->setRequired(false);
        $select->addOption(new Option('1', 'One'));

        self::assertFalse($select->isRequired());
        self::assertSame('<select name="foo"><option value="1">One</option></select>', $select->getHtml());
        self::assertSame('<select name="foo"><option value="1">One</option></select>', $select->__toString());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $select = new Select('foo', '2');
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));

        self::assertSame('<select name="foo"><option value="1">One</option><option value="2" selected>Two</option></select>', $select->getHtml());
        self::assertSame('<select name="foo"><option value="1">One</option><option value="2" selected>Two</option></select>', $select->__toString());
        self::assertSame('2', $select->getValue());
    }

    /**
     * Test setFormValue method with invalid value.
     */
    public function testSetFormValueWithInvalidValue()
    {
        $select = new Select('foo');
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));
        $select->setFormValue('3');

        self::assertSame('<select name="foo"><option value="1">One</option><option value="2">Two</option></select>', $select->getHtml());
        self::assertSame('<select name="foo"><option value="1">One</option><option value="2">Two</option></select>', $select->__toString());
        self::assertSame('', $select->getValue());
        self::assertTrue($select->hasError());
        self::assertSame('Missing value', $select->getError());
    }

    /**
     * Test setFormValue method with invalid value does not change default value.
     */
    public function testSetFormValueWithInvalidValueDoesNotChangeDefaultValue()
    {
        $select = new Select('foo', '1');
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));
        $select->setFormValue('3');

        self::assertSame('<select name="foo"><option value="1">One</option><option value="2">Two</option></select>', $select->getHtml());
        self::assertSame('<select name="foo"><option value="1">One</option><option value="2">Two</option></select>', $select->__toString());
        self::assertSame('1', $select->getValue());
        self::assertFalse($select->hasError());
        self::assertNull($select->getError());
    }

    /**
     * Test countable for select.
     */
    public function testCountable()
    {
        $select = new Select('foo', '1');
        $select->addOption(new Option('1', 'One'));
        $select->addOption(new Option('2', 'Two'));

        self::assertSame(2, count($select));
    }
}
