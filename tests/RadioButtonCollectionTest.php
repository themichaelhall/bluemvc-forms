<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Forms\RadioButton;
use BlueMvc\Forms\RadioButtonCollection;

/**
 * Test RadioButtonCollection class.
 */
class RadioButtonCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test basic constructor.
     */
    public function testBasicConstructor()
    {
        $select = new RadioButtonCollection('foo');

        self::assertSame('', $select->getHtml());
        self::assertSame('', $select->__toString());
    }

    /**
     * Test constructor with invalid name parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $name parameter is not a string.
     */
    public function testConstructorWithInvalidNameParameterType()
    {
        new RadioButtonCollection(true);
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
        $radioButtonCollection = new RadioButtonCollection('foo', '2');
        $radioButtonCollection->addRadioButton(new RadioButton('1', 'One'));
        $radioButtonCollection->addRadioButton(new RadioButton('2', 'Two'));

        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2" checked>Two', $radioButtonCollection->getHtml());
        self::assertSame('<input type="radio" name="foo" value="1">One<input type="radio" name="foo" value="2" checked>Two', $radioButtonCollection->__toString());
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
    public function testSetFormValue($isRequired, $value, $expectedValue, $expectedHtml, $expectedIsEmpty, $expectedHasError, $expectedError)
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
    public function setFormValueDataProvider()
    {
        return [
            [false, '', '', '<input type="radio" name="foo" value="" checked>None<input type="radio" name="foo" value="1">One', true, false, null],
            [true, '', '', '<input type="radio" name="foo" value="" checked>None<input type="radio" name="foo" value="1">One', true, true, 'Missing value'],
            [false, '1', '1', '<input type="radio" name="foo" value="">None<input type="radio" name="foo" value="1" checked>One', false, false, null],
            [true, '1', '1', '<input type="radio" name="foo" value="">None<input type="radio" name="foo" value="1" checked>One', false, false, null],
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
        $select = new RadioButtonCollection('foo');
        $select->addRadioButton(new RadioButton('1', 'One'));
        $select->addRadioButton(new RadioButton('2', 'Two'));
        $select->setFormValue(2);
    }

    /**
     * Test isEmpty method.
     */
    public function testIsEmpty()
    {
        $radioButtonCollection = new RadioButtonCollection('foo', 'bar');

        self::assertFalse($radioButtonCollection->isEmpty());
    }

    /**
     * Test constructor with invalid default value parameter type.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $value parameter is not a string.
     */
    public function testConstructorWithInvalidDefaultValueParameterType()
    {
        new RadioButtonCollection('foo', 2);
    }
}
