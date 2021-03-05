<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\RadioButton;
use BlueMvc\Forms\RadioButtonCollection;
use PHPUnit\Framework\TestCase;

/**
 * Test RadioButtonCollection class.
 */
class RadioButtonCollectionTest extends TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertSame('', $radioButtonCollection->getHtml());
        self::assertSame('', $radioButtonCollection->__toString());
    }

    /**
     * Test getName method.
     */
    public function testGetName()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertSame('foo', $radioButtonCollection->getName());
    }

    /**
     * Test getValue method.
     */
    public function testGetValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertSame('', $radioButtonCollection->getValue());
    }

    /**
     * Test addRadioButton method.
     */
    public function testAddRadioButton()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));

        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2">Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2">Two', $radioButtonCollection->__toString());
    }

    /**
     * Test addRadioButton method with one radio button selected.
     */
    public function testAddRadioButtonWithOneRadioButtonSelected()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('', 'None'));
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));

        self::assertSame('<input type="radio" name="foo" value="" checked>None<input type="radio" name="foo" value="1">One', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="" checked>None<input type="radio" name="foo" value="1">One', $radioButtonCollection->__toString());
    }

    /**
     * Test getRadioButtons method.
     */
    public function testGetRadioButtons()
    {
        $radioButton1 = new RadioButton('', 'None');
        $radioButton2 = new RadioButton('1', 'One');

        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton($radioButton1);
        $radioButtonCollection->addRadioButton($radioButton2);

        self::assertSame([$radioButton1, $radioButton2], $radioButtonCollection->getRadioButtons());
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
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->setRequired($isRequired);
        $radioButtonCollection->addRadioButton(new RadioButton('', 'None'));
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->setFormValue($value);

        self::assertSame($expectedHtml, $radioButtonCollection->getHtml());
        self::assertSame($expectedHtml, $radioButtonCollection->__toString());
        self::assertSame($expectedValue, $radioButtonCollection->getValue());
        self::assertSame($expectedIsEmpty, $radioButtonCollection->isEmpty());
        self::assertSame($expectedHasError, $radioButtonCollection->hasError());
        self::assertSame($expectedError, $radioButtonCollection->getError());
    }

    /**
     * Data provider for testSetFormValue method.
     *
     * @return array The data.
     */
    public function setFormValueDataProvider(): array
    {
        return [
            [false, '', '', '<input type="radio" name="foo" value="" checked>None<input type="radio" name="foo" value="1">One', true, false, null],
            [true, '', '', '<input type="radio" name="foo" value="" checked>None<input type="radio" name="foo" value="1">One', true, true, 'Missing value'],
            [false, '1', '1', '<input type="radio" name="foo" value="">None<input type="radio" name="foo" value="1" checked>One', false, false, null],
            [true, '1', '1', '<input type="radio" name="foo" value="">None<input type="radio" name="foo" value="1" checked>One', false, false, null],
        ];
    }

    /**
     * Test that output is html-encoded.
     */
    public function testOutputIsHtmlEncoded()
    {
        $radioButtonCollection = new RadioButtonCollection('<p>foo</p>');
        $radioButtonCollection->addRadioButton(new RadioButton('<span>1</span>', '<h1>One</h1>'));

        self::assertSame('<input type="radio" name="&lt;p&gt;foo&lt;/p&gt;" value="&lt;span&gt;1&lt;/span&gt;">&lt;h1&gt;One&lt;/h1&gt;', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="&lt;p&gt;foo&lt;/p&gt;" value="&lt;span&gt;1&lt;/span&gt;">&lt;h1&gt;One&lt;/h1&gt;', $radioButtonCollection->__toString());
        self::assertSame('', $radioButtonCollection->getValue());
    }

    /**
     * Test getHtml method with attributes.
     */
    public function testGetHtmlWithAttributes()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));

        self::assertSame('<input type="radio" name="foo" value="1" class="my-radio">One<input type="radio" name="foo" value="2" class="my-radio">Two', $radioButtonCollection->getHtml(['class' => 'my-radio']));
    }

    /**
     * Test isEmpty method for empty value.
     */
    public function testIsEmptyForEmptyValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('', 'None'));
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));

        self::assertTrue($radioButtonCollection->isEmpty());
    }

    /**
     * Test isEmpty method for non-empty value.
     */
    public function testIsEmptyForNonEmptyValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('', 'None'));
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->setFormValue('1');

        self::assertFalse($radioButtonCollection->isEmpty());
    }

    /**
     * Test hasError method.
     */
    public function testHasError()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertFalse($radioButtonCollection->hasError());
    }

    /**
     * Test getError method.
     */
    public function testGetError()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertNull($radioButtonCollection->getError());
    }

    /**
     * Test setError method.
     */
    public function testSetError()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->setError('My Error');

        self::assertTrue($radioButtonCollection->hasError());
        self::assertSame('My Error', $radioButtonCollection->getError());
    }

    /**
     * Test isRequired method.
     */
    public function testIsRequired()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertTrue($radioButtonCollection->isRequired());
    }

    /**
     * Test setRequired method.
     */
    public function testSetRequired()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->setRequired(false);

        self::assertFalse($radioButtonCollection->isRequired());
    }

    /**
     * Test constructor with default value.
     */
    public function testConstructorWithDefaultValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', '2');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));

        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2" checked>Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2" checked>Two', $radioButtonCollection->__toString());
        self::assertSame('2', $radioButtonCollection->getValue());
    }

    /**
     * Test setFormValue method with invalid value.
     */
    public function testSetFormValueWithInvalidValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));
        $radioButtonCollection->setFormValue('3');

        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2">Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2">Two', $radioButtonCollection->__toString());
        self::assertSame('', $radioButtonCollection->getValue());
        self::assertTrue($radioButtonCollection->hasError());
        self::assertSame('Missing value', $radioButtonCollection->getError());
    }

    /**
     * Test setFormValue method with invalid value does not change default value.
     */
    public function testSetFormValueWithInvalidValueDoesNotChangeDefaultValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', '1');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));
        $radioButtonCollection->setFormValue('3');

        self::assertSame('<input type="radio" name="foo" value="1" checked>One<input type="radio" name="foo" value="2">Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1" checked>One<input type="radio" name="foo" value="2">Two', $radioButtonCollection->__toString());
        self::assertSame('1', $radioButtonCollection->getValue());
        self::assertFalse($radioButtonCollection->hasError());
        self::assertNull($radioButtonCollection->getError());
    }

    /**
     * Test countable for radio button collection.
     */
    public function testCountable()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', '1');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));

        self::assertSame(2, count($radioButtonCollection));
    }

    /**
     * Test iterable for radio button collection.
     */
    public function testIterable()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', '1');
        $radioButton1 = new RadioButton('1', 'One');
        $radioButton2 = new RadioButton('Foo', 'Bar');
        $radioButtonCollection->addRadioButton($radioButton1);
        $radioButtonCollection->addRadioButton($radioButton2);

        self::assertSame([1 => $radioButton1, 'Foo' => $radioButton2], iterator_to_array($radioButtonCollection));
    }

    /**
     * Test getLabel method.
     */
    public function testGetLabel()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertSame('', $radioButtonCollection->getLabel());
    }

    /**
     * Test setLabel method.
     */
    public function testSetLabel()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->setLabel('My label');

        self::assertSame('My label', $radioButtonCollection->getLabel());
    }

    /**
     * Test getCustomData method.
     */
    public function testGetCustomData()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertNull($radioButtonCollection->getCustomData());
    }

    /**
     * Test setCustomData method.
     */
    public function testSetCustomData()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->setCustomData(0);

        self::assertSame(0, $radioButtonCollection->getCustomData());
    }

    /**
     * Test get selected radio button with no radio button selected.
     */
    public function testGetSelectedRadioButtonWithNoRadioButtonSelected()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButton1 = new RadioButton('1', 'One');
        $radioButton2 = new RadioButton('2', 'Two');
        $radioButtonCollection->addRadioButton($radioButton1);
        $radioButtonCollection->addRadioButton($radioButton2);

        self::assertNull($radioButtonCollection->getSelectedRadioButton());
    }

    /**
     * Test get selected radio button with radio button selected.
     */
    public function testGetSelectedRadioButtonWithRadioButtonSelected()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', '1');
        $radioButton1 = new RadioButton('1', 'One');
        $radioButton2 = new RadioButton('2', 'Two');
        $radioButtonCollection->addRadioButton($radioButton1);
        $radioButtonCollection->addRadioButton($radioButton2);

        self::assertSame($radioButton1, $radioButtonCollection->getSelectedRadioButton());
    }

    /**
     * Test isDisabled method.
     */
    public function testIsDisabled()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');

        self::assertFalse($radioButtonCollection->isDisabled());
    }

    /**
     * Test setDisabled method.
     */
    public function testSetDisabled()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->setDisabled(true);
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));

        self::assertTrue($radioButtonCollection->isDisabled());
        self::assertSame('<input type="radio" name="foo" value="1" disabled>One<input type="radio" name="foo" value="2" disabled>Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1" disabled>One<input type="radio" name="foo" value="2" disabled>Two', $radioButtonCollection->__toString());
    }

    /**
     * Test setFormValue method with disabled radio button.
     */
    public function testSetFormValueWithDisabledRadioButton()
    {
        $radioButtonCollection = new RadioButtonCollection('foo');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButton2 = new RadioButton('2', 'Two');
        $radioButton2->setDisabled(true);
        $radioButtonCollection->addRadioButton($radioButton2);
        $radioButtonCollection->setFormValue('2');

        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2" disabled>Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2" disabled>Two', $radioButtonCollection->__toString());
        self::assertSame('', $radioButtonCollection->getValue());
        self::assertTrue($radioButtonCollection->hasError());
        self::assertSame('Missing value', $radioButtonCollection->getError());
    }

    /**
     * Test setFormValue method with disabled radio button does not change default value.
     */
    public function testSetFormValueWithDisabledRadioButtonDoesNotChangeDefaultValue()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', '1');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButton2 = new RadioButton('2', 'Two');
        $radioButton2->setDisabled(true);
        $radioButtonCollection->addRadioButton($radioButton2);
        $radioButtonCollection->setFormValue('2');

        self::assertSame('<input type="radio" name="foo" value="1" checked>One<input type="radio" name="foo" value="2" disabled>Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1" checked>One<input type="radio" name="foo" value="2" disabled>Two', $radioButtonCollection->__toString());
        self::assertSame('1', $radioButtonCollection->getValue());
        self::assertFalse($radioButtonCollection->hasError());
        self::assertNull($radioButtonCollection->getError());
    }
}
