<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\BasicTestGetForm;
use PHPUnit\Framework\TestCase;

/**
 * Test GetForm class.
 */
class GetFormTest extends TestCase
{
    /**
     * Test process with no query request.
     */
    public function testProcessWithNoQueryRequest()
    {
        $request = new FakeRequest('/');

        $form = new BasicTestGetForm();
        $isProcessed = $form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame([], $form->getEventMethodsCalled());
        self::assertFalse($form->hasError());
        self::assertSame([], $form->getProcessedElements());
        self::assertFalse($form->isProcessed());

        self::assertSame('', $form->getNotRequiredField()->getValue());
        self::assertFalse($form->getNotRequiredField()->hasError());

        self::assertSame('', $form->getCustomValidatedField()->getValue());
        self::assertFalse($form->getCustomValidatedField()->hasError());

        self::assertSame('', $form->getTextField()->getValue());
        self::assertFalse($form->getTextField()->hasError());

        self::assertSame('', $form->getPasswordField()->getValue());
        self::assertFalse($form->getPasswordField()->hasError());

        self::assertSame('', $form->getNameField()->getValue());
        self::assertFalse($form->getNameField()->hasError());

        self::assertSame(null, $form->getUrlField()->getValue());
        self::assertFalse($form->getUrlField()->hasError());

        self::assertSame(false, $form->getCheckBox()->getValue());
        self::assertFalse($form->getCheckBox()->hasError());

        self::assertSame('', $form->getTextArea()->getValue());
        self::assertFalse($form->getTextArea()->hasError());

        self::assertSame('', $form->getSelect()->getValue());
        self::assertFalse($form->getSelect()->hasError());

        self::assertNull($form->getEmailField()->getValue());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertNull($form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertNull($form->getDateField()->getValue());
        self::assertFalse($form->getDateField()->hasError());

        self::assertSame('', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertNull($form->getDateTimeField()->getValue());
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField1()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('This is the default value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with post request.
     */
    public function testProcessWithPostRequest()
    {
        $request = new FakeRequest('/', 'POST');

        $form = new BasicTestGetForm();
        $isProcessed = $form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame([], $form->getEventMethodsCalled());
        self::assertFalse($form->hasError());
        self::assertSame([], $form->getProcessedElements());
        self::assertFalse($form->isProcessed());

        self::assertSame('', $form->getNotRequiredField()->getValue());
        self::assertFalse($form->getNotRequiredField()->hasError());

        self::assertSame('', $form->getCustomValidatedField()->getValue());
        self::assertFalse($form->getCustomValidatedField()->hasError());

        self::assertSame('', $form->getTextField()->getValue());
        self::assertFalse($form->getTextField()->hasError());

        self::assertSame('', $form->getPasswordField()->getValue());
        self::assertFalse($form->getPasswordField()->hasError());

        self::assertSame('', $form->getNameField()->getValue());
        self::assertFalse($form->getNameField()->hasError());

        self::assertSame(null, $form->getUrlField()->getValue());
        self::assertFalse($form->getUrlField()->hasError());

        self::assertSame(false, $form->getCheckBox()->getValue());
        self::assertFalse($form->getCheckBox()->hasError());

        self::assertSame('', $form->getTextArea()->getValue());
        self::assertFalse($form->getTextArea()->hasError());

        self::assertSame('', $form->getSelect()->getValue());
        self::assertFalse($form->getSelect()->hasError());

        self::assertNull($form->getEmailField()->getValue());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertNull($form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertNull($form->getDateField()->getValue());
        self::assertFalse($form->getDateField()->hasError());

        self::assertSame('', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertNull($form->getDateTimeField()->getValue());
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField1()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('This is the default value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with get request.
     */
    public function testProcessWithGetRequest()
    {
        $request = new FakeRequest(
            '/?' .
            'not-required=My%20not%20required%20value&' .
            'custom-validated=My%20custom%20validated%20value&' .
            'text=My%20text%20value&' .
            'password=My%20password&' .
            'name=My%20name&' .
            'url=https%3A%2F%2Fdomain.com%2Ffoo&' .
            'checkbox=on&' .
            'textarea=My%0AText&' .
            'select=bar&' .
            'email=foo.bar%40example.com&' .
            'hidden=My%20hidden%20value&' .
            'integer=12345&' .
            'date=2017-10-15&' .
            'radio=foo&' .
            'datetime=2017-12-01T10:20:30&' .
            'private-1=0&' .
            'private-2=My%20private%20field%202%20value&' .
            'group-1-text-1=My%20group%201%20text%201%20value&' .
            'group-1-text-2=My%20group%201%20text%202%20value&' .
            'group-2-1-text=My%20group%202%20inner%20group%201%20text%20value&' .
            'group-2-1-checkbox=on&' .
            'group-2-1-private-text=My%20group%202%20inner%20group%201%20private%20text%20value&' .
            'group-2-2-text=My%20group%202%20inner%20group%202%20text%20value&' .
            'group-2-2-checkbox=on&' .
            'group-2-2-private-text=My%20group%202%20inner%20group%202%20private%20text%20value&' .
            'group-1-url-1=https%3A%2F%2Fexample.com%2F&' .
            'group-2-3-text=My%20group%202%20inner%20group%203%20text%20value&' .
            'group-2-3-checkbox=on&' .
            'group-2-3-private-text=My%20group%202%20inner%20group%203%20private%20text%20value&' .
            'group-3-text=My%20group%203%20text%20value&' .
            'group-3-checkbox=on&' .
            'group-3-private-text=My%20group%203%20private%20text%20value&' .
            'group-4-text=My%20group%204%20text%20value&' .
            'group-4-checkbox=on&' .
            'group-4-private-text=My%20group%204%20private%20text%20value&' .
            'default-value=A%20new%20value'
        );

        $form = new BasicTestGetForm();
        $isProcessed = $form->process($request);

        self::assertTrue($isProcessed);
        self::assertSame(['onValidate', 'onSuccess', 'onProcessed'], $form->getEventMethodsCalled());
        self::assertFalse($form->hasError());
        self::assertSame(
            [
                $form->getNotRequiredField(),
                $form->getCustomValidatedField(),
                $form->getTextField(),
                $form->getPasswordField(),
                $form->getNameField(),
                $form->getUrlField(),
                $form->getCheckBox(),
                $form->getTextArea(),
                $form->getSelect(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getOuterFormElementGroup(),
                $form->getOuterFormElementGroup()->getTextField1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox(),
                $form->getOuterFormElementGroup()->getTextField2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox(),
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getTextField(),
                $form->getPrivateFormElementGroup1()->getCheckBox(),
            ],
            $form->getProcessedElements()
        );
        self::assertTrue($form->isProcessed());

        self::assertSame('My not required value', $form->getNotRequiredField()->getValue());
        self::assertFalse($form->getNotRequiredField()->hasError());

        self::assertSame('My custom validated value', $form->getCustomValidatedField()->getValue());
        self::assertFalse($form->getCustomValidatedField()->hasError());

        self::assertSame('My text value', $form->getTextField()->getValue());
        self::assertFalse($form->getTextField()->hasError());

        self::assertSame('My password', $form->getPasswordField()->getValue());
        self::assertFalse($form->getPasswordField()->hasError());

        self::assertSame('My Name', $form->getNameField()->getValue());
        self::assertFalse($form->getNameField()->hasError());

        self::assertSame('https://domain.com/foo', $form->getUrlField()->getValue()->__toString());
        self::assertFalse($form->getUrlField()->hasError());

        self::assertTrue($form->getCheckBox()->getValue());
        self::assertFalse($form->getCheckBox()->hasError());

        self::assertSame("My\r\nText", $form->getTextArea()->getValue());
        self::assertFalse($form->getTextArea()->hasError());

        self::assertSame('bar', $form->getSelect()->getValue());
        self::assertFalse($form->getSelect()->hasError());

        self::assertSame('foo.bar@example.com', $form->getEmailField()->getValue()->__toString());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('My hidden value', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertSame(12345, $form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertSame('2017-10-15 00:00:00', $form->getDateField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateField()->hasError());

        self::assertSame('foo', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertSame('2017-12-01 10:20:00', $form->getDateTimeField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('0', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->hasError());

        self::assertSame('My group 1 text 1 value', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField1()->hasError());

        self::assertSame('My group 1 text 2 value', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());

        self::assertSame('My group 2 inner group 1 text value', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());

        self::assertSame('My group 2 inner group 2 text value', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('My group 3 text value', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getTextField()->hasError());

        self::assertTrue($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('A new value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with empty get request.
     */
    public function testProcessWithEmptyGetRequest()
    {
        $request = new FakeRequest('/?');

        $form = new BasicTestGetForm();
        $isProcessed = $form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $form->getEventMethodsCalled());
        self::assertTrue($form->hasError());
        self::assertSame(
            [
                $form->getNotRequiredField(),
                $form->getCustomValidatedField(),
                $form->getTextField(),
                $form->getPasswordField(),
                $form->getNameField(),
                $form->getUrlField(),
                $form->getCheckBox(),
                $form->getTextArea(),
                $form->getSelect(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getOuterFormElementGroup(),
                $form->getOuterFormElementGroup()->getTextField1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox(),
                $form->getOuterFormElementGroup()->getTextField2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox(),
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getTextField(),
                $form->getPrivateFormElementGroup1()->getCheckBox(),
            ],
            $form->getProcessedElements()
        );
        self::assertTrue($form->isProcessed());

        self::assertSame('', $form->getNotRequiredField()->getValue());
        self::assertFalse($form->getNotRequiredField()->hasError());

        self::assertSame('', $form->getCustomValidatedField()->getValue());
        self::assertTrue($form->getCustomValidatedField()->hasError());
        self::assertSame('Missing value', $form->getCustomValidatedField()->getError());

        self::assertSame('', $form->getTextField()->getValue());
        self::assertTrue($form->getTextField()->hasError());
        self::assertSame('Value of text field is empty.', $form->getTextField()->getError());

        self::assertSame('', $form->getPasswordField()->getValue());
        self::assertTrue($form->getPasswordField()->hasError());
        self::assertSame('Missing value', $form->getPasswordField()->getError());

        self::assertSame('', $form->getNameField()->getValue());
        self::assertTrue($form->getNameField()->hasError());
        self::assertSame('Missing value', $form->getNameField()->getError());

        self::assertNull($form->getUrlField()->getValue());
        self::assertTrue($form->getUrlField()->hasError());
        self::assertSame('Missing value', $form->getUrlField()->getError());

        self::assertFalse($form->getCheckBox()->getValue());
        self::assertTrue($form->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getCheckBox()->getError());

        self::assertSame('', $form->getTextArea()->getValue());
        self::assertTrue($form->getTextArea()->hasError());
        self::assertSame('Missing value', $form->getTextArea()->getError());

        self::assertSame('', $form->getSelect()->getValue());
        self::assertTrue($form->getSelect()->hasError());
        self::assertSame('Missing value', $form->getSelect()->getError());

        self::assertNull($form->getEmailField()->getValue());
        self::assertTrue($form->getEmailField()->hasError());
        self::assertSame('Missing value', $form->getEmailField()->getError());

        self::assertSame('', $form->getHiddenField()->getValue());
        self::assertTrue($form->getHiddenField()->hasError());
        self::assertSame('Missing value', $form->getHiddenField()->getError());

        self::assertNull($form->getIntegerField()->getValue());
        self::assertTrue($form->getIntegerField()->hasError());
        self::assertSame('Missing value', $form->getIntegerField()->getError());

        self::assertNull($form->getDateField()->getValue());
        self::assertTrue($form->getDateField()->hasError());
        self::assertSame('Missing value', $form->getDateField()->getError());

        self::assertSame('', $form->getRadioButtons()->getValue());
        self::assertTrue($form->getRadioButtons()->hasError());
        self::assertSame('Missing value', $form->getRadioButtons()->getError());

        self::assertNull($form->getDateTimeField()->getValue());
        self::assertTrue($form->getDateTimeField()->hasError());
        self::assertSame('Missing value', $form->getDateTimeField()->getError());

        self::assertSame('', $form->getPrivateField1()->getValue());
        self::assertTrue($form->getPrivateField1()->hasError());
        self::assertSame('Missing value', $form->getPrivateField1()->getError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());
        self::assertNull($form->getPrivateField2()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getTextField1()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getTextField1()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getTextField2()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getTextField2()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getTextField()->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getTextField()->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getCheckBox()->getError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('', $form->getDefaultValueElement()->getValue());
        self::assertTrue($form->getDefaultValueElement()->hasError());
        self::assertSame('Missing value', $form->getDefaultValueElement()->getError());
    }

    /**
     * Test process with invalid values in get request.
     */
    public function testProcessWithInvalidValuesInGetRequest()
    {
        $request = new FakeRequest(
            '/?' .
            'not-required=invalid&' .
            'custom-validated=invalid&' .
            'text=invalid&' .
            'password=invalid&' .
            'name=invalid&' .
            'url=invalid&' .
            'checkbox=invalid&' .
            'textarea=invalid&' .
            'select=baz&' .
            'email=invalid&' .
            'hidden=invalid&' .
            'integer=invalid&' .
            'date=invalid&' .
            'radio=baz&' .
            'datetime=invalid&' .
            'private-1=invalid&' .
            'private-2=invalid&' .
            'group-1-text-1=invalid&' .
            'group-1-text-2=invalid&' .
            'group-2-1-text=invalid&' .
            'group-2-1-checkbox=invalid&' .
            'group-2-1-private-text=invalid&' .
            'group-2-2-text=invalid&' .
            'group-2-2-checkbox=invalid&' .
            'group-2-2-private-text=invalid&' .
            'group-1-url-1=invalid&' .
            'group-2-3-text=invalid&' .
            'group-2-3-checkbox=invalid&' .
            'group-2-3-private-text=invalid&' .
            'group-3-text=invalid&' .
            'group-3-checkbox=invalid&' .
            'group-3-private-text=invalid&' .
            'group-4-text=invalid&' .
            'group-4-checkbox=invalid&' .
            'group-4-private-text=invalid&' .
            'default-value=invalid'
        );

        $form = new BasicTestGetForm();
        $isProcessed = $form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $form->getEventMethodsCalled());
        self::assertTrue($form->hasError());
        self::assertSame(
            [
                $form->getNotRequiredField(),
                $form->getCustomValidatedField(),
                $form->getTextField(),
                $form->getPasswordField(),
                $form->getNameField(),
                $form->getUrlField(),
                $form->getCheckBox(),
                $form->getTextArea(),
                $form->getSelect(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getOuterFormElementGroup(),
                $form->getOuterFormElementGroup()->getTextField1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox(),
                $form->getOuterFormElementGroup()->getTextField2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox(),
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getTextField(),
                $form->getPrivateFormElementGroup1()->getCheckBox(),
            ],
            $form->getProcessedElements()
        );
        self::assertTrue($form->isProcessed());

        self::assertSame('invalid', $form->getNotRequiredField()->getValue());
        self::assertTrue($form->getNotRequiredField()->hasError());
        self::assertSame('Value of not required field is invalid.', $form->getNotRequiredField()->getError());

        self::assertSame('invalid', $form->getCustomValidatedField()->getValue());
        self::assertTrue($form->getCustomValidatedField()->hasError());
        self::assertSame('Value of custom validated field is invalid.', $form->getCustomValidatedField()->getError());

        self::assertSame('invalid', $form->getTextField()->getValue());
        self::assertTrue($form->getTextField()->hasError());
        self::assertSame('Value of text field is invalid.', $form->getTextField()->getError());

        self::assertSame('invalid', $form->getPasswordField()->getValue());
        self::assertTrue($form->getPasswordField()->hasError());
        self::assertSame('Value of password field is invalid.', $form->getPasswordField()->getError());

        self::assertSame('Invalid', $form->getNameField()->getValue());
        self::assertTrue($form->getNameField()->hasError());
        self::assertSame('Value of name field is invalid.', $form->getNameField()->getError());

        self::assertNull($form->getUrlField()->getValue());
        self::assertTrue($form->getUrlField()->hasError());
        self::assertSame('Invalid value', $form->getUrlField()->getError());

        self::assertFalse($form->getCheckBox()->getValue());
        self::assertTrue($form->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getCheckBox()->getError());

        self::assertSame('invalid', $form->getTextArea()->getValue());
        self::assertTrue($form->getTextArea()->hasError());
        self::assertSame('Value of text area is invalid.', $form->getTextArea()->getError());

        self::assertSame('', $form->getSelect()->getValue());
        self::assertTrue($form->getSelect()->hasError());
        self::assertSame('Missing value', $form->getSelect()->getError());

        self::assertNull($form->getEmailField()->getValue());
        self::assertTrue($form->getEmailField()->hasError());
        self::assertSame('Invalid value', $form->getEmailField()->getError());

        self::assertSame('invalid', $form->getHiddenField()->getValue());
        self::assertTrue($form->getHiddenField()->hasError());
        self::assertSame('Value of hidden field is invalid.', $form->getHiddenField()->getError());

        self::assertNull($form->getIntegerField()->getValue());
        self::assertTrue($form->getIntegerField()->hasError());
        self::assertSame('Invalid value', $form->getIntegerField()->getError());

        self::assertNull($form->getDateField()->getValue());
        self::assertTrue($form->getDateField()->hasError());
        self::assertSame('Invalid value', $form->getDateField()->getError());

        self::assertSame('', $form->getRadioButtons()->getValue());
        self::assertTrue($form->getRadioButtons()->hasError());
        self::assertSame('Missing value', $form->getRadioButtons()->getError());

        self::assertNull($form->getDateTimeField()->getValue());
        self::assertTrue($form->getDateTimeField()->hasError());
        self::assertSame('Invalid value', $form->getDateTimeField()->getError());

        self::assertSame('invalid', $form->getPrivateField1()->getValue());
        self::assertTrue($form->getPrivateField1()->hasError());
        self::assertSame('Value of private field 1 is invalid.', $form->getPrivateField1()->getError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());
        self::assertNull($form->getPrivateField2()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->hasError());

        self::assertSame('invalid', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getTextField1()->hasError());
        self::assertSame('Value of outer group text field 1 is invalid.', $form->getOuterFormElementGroup()->getTextField1()->getError());

        self::assertSame('invalid', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getTextField2()->hasError());
        self::assertSame('Value of outer group text field 2 is invalid.', $form->getOuterFormElementGroup()->getTextField2()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());

        self::assertSame('invalid', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());
        self::assertSame('Value of inner group 1 text field is invalid.', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());

        self::assertSame('invalid', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());
        self::assertSame('Value of inner group 2 text field is invalid.', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('invalid', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getTextField()->hasError());
        self::assertSame('Value of private group 1 text field is invalid.', $form->getPrivateFormElementGroup1()->getTextField()->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getCheckBox()->getError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('invalid', $form->getDefaultValueElement()->getValue());
        self::assertTrue($form->getDefaultValueElement()->hasError());
        self::assertSame('Value is invalid.', $form->getDefaultValueElement()->getError());
    }

    /**
     * Test process with element group error.
     */
    public function testProcessWithElementGroupError()
    {
        $request = new FakeRequest(
            '/?' .
            'not-required=My%20not%20required%20value&' .
            'custom-validated=My%20custom%20validated%20value&' .
            'text=My%20text%20value&' .
            'password=My%20password&' .
            'name=My%20name&' .
            'url=https%3A%2F%2Fdomain.com%2Ffoo&' .
            'checkbox=on&' .
            'textarea=My%0AText&' .
            'select=bar&' .
            'email=foo.bar%40example.com&' .
            'hidden=My%20hidden%20value&' .
            'integer=12345&' .
            'date=2017-10-15&' .
            'radio=foo&' .
            'datetime=2017-12-01T10:20:30&' .
            'private-1=0&' .
            'private-2=My%20private%20field%202%20value&' .
            'group-1-text-1=invalid-group&' .
            'group-1-text-2=My%20group%201%20text%202%20value&' .
            'group-2-1-text=invalid-group&' .
            'group-2-1-checkbox=on&' .
            'group-2-1-private-text=My%20group%202%20inner%20group%201%20private%20text%20value&' .
            'group-2-2-text=invalid-group&' .
            'group-2-2-checkbox=on&' .
            'group-2-2-private-text=My%20group%202%20inner%20group%202%20private%20text%20value&' .
            'group-1-url-1=https%3A%2F%2Fexample.com%2F&' .
            'group-2-3-text=invalid-group&' .
            'group-2-3-checkbox=on&' .
            'group-2-3-private-text=My%20group%202%20inner%20group%203%20private%20text%20value&' .
            'group-3-text=invalid-group&' .
            'group-3-checkbox=on&' .
            'group-3-private-text=My%20group%203%20private%20text%20value&' .
            'group-4-text=invalid-group&' .
            'group-4-checkbox=on&' .
            'group-4-private-text=My%20group%204%20private%20text%20value&' .
            'default-value=A%20new%20value'
        );

        $form = new BasicTestGetForm();
        $isProcessed = $form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $form->getEventMethodsCalled());
        self::assertTrue($form->hasError());
        self::assertSame(
            [
                $form->getNotRequiredField(),
                $form->getCustomValidatedField(),
                $form->getTextField(),
                $form->getPasswordField(),
                $form->getNameField(),
                $form->getUrlField(),
                $form->getCheckBox(),
                $form->getTextArea(),
                $form->getSelect(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getOuterFormElementGroup(),
                $form->getOuterFormElementGroup()->getTextField1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox(),
                $form->getOuterFormElementGroup()->getTextField2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox(),
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getTextField(),
                $form->getPrivateFormElementGroup1()->getCheckBox(),
            ],
            $form->getProcessedElements()
        );
        self::assertTrue($form->isProcessed());

        self::assertSame('My not required value', $form->getNotRequiredField()->getValue());
        self::assertFalse($form->getNotRequiredField()->hasError());

        self::assertSame('My custom validated value', $form->getCustomValidatedField()->getValue());
        self::assertFalse($form->getCustomValidatedField()->hasError());

        self::assertSame('My text value', $form->getTextField()->getValue());
        self::assertFalse($form->getTextField()->hasError());

        self::assertSame('My password', $form->getPasswordField()->getValue());
        self::assertFalse($form->getPasswordField()->hasError());

        self::assertSame('My Name', $form->getNameField()->getValue());
        self::assertFalse($form->getNameField()->hasError());

        self::assertSame('https://domain.com/foo', $form->getUrlField()->getValue()->__toString());
        self::assertFalse($form->getUrlField()->hasError());

        self::assertTrue($form->getCheckBox()->getValue());
        self::assertFalse($form->getCheckBox()->hasError());

        self::assertSame("My\r\nText", $form->getTextArea()->getValue());
        self::assertFalse($form->getTextArea()->hasError());

        self::assertSame('bar', $form->getSelect()->getValue());
        self::assertFalse($form->getSelect()->hasError());

        self::assertSame('foo.bar@example.com', $form->getEmailField()->getValue()->__toString());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('My hidden value', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertSame(12345, $form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertSame('2017-10-15 00:00:00', $form->getDateField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateField()->hasError());

        self::assertSame('foo', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertSame('2017-12-01 10:20:00', $form->getDateTimeField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('0', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->hasError());
        self::assertSame('Outer group is invalid.', $form->getOuterFormElementGroup()->getError());

        self::assertSame('invalid-group', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField1()->hasError());

        self::assertSame('My group 1 text 2 value', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getTextField2()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());
        self::assertSame('Inner group 1 is invalid.', $form->getOuterFormElementGroup()->getFormElementGroup1()->getError());

        self::assertSame('invalid-group', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());
        self::assertSame('Inner group 2 is invalid.', $form->getOuterFormElementGroup()->getFormElementGroup2()->getError());

        self::assertSame('invalid-group', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());

        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertTrue($form->getPrivateFormElementGroup1()->hasError());
        self::assertSame('Private group 1 is invalid.', $form->getPrivateFormElementGroup1()->getError());

        self::assertSame('invalid-group', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getTextField()->hasError());

        self::assertTrue($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('A new value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with elements disabled.
     */
    public function testProcessWithElementsDisabled()
    {
        $request = new FakeRequest(
            '/?' .
            'not-required=My%20not%20required%20value&' .
            'custom-validated=My%20custom%20validated%20value&' .
            'text=My%20text%20value&' .
            'password=My%20password&' .
            'name=My%20name&' .
            'url=https%3A%2F%2Fdomain.com%2Ffoo&' .
            'checkbox=on&' .
            'textarea=My%0AText&' .
            'select=bar&' .
            'email=foo.bar%40example.com&' .
            'hidden=My%20hidden%20value&' .
            'integer=12345&' .
            'date=2017-10-15&' .
            'radio=foo&' .
            'datetime=2017-12-01T10:20:30&' .
            'private-1=0&' .
            'private-2=My%20private%20field%202%20value&' .
            'group-1-text-1=My%20group%201%20text%201%20value&' .
            'group-1-text-2=My%20group%201%20text%202%20value&' .
            'group-2-1-text=My%20group%202%20inner%20group%201%20text%20value&' .
            'group-2-1-checkbox=on&' .
            'group-2-1-private-text=My%20group%202%20inner%20group%201%20private%20text%20value&' .
            'group-2-2-text=My%20group%202%20inner%20group%202%20text%20value&' .
            'group-2-2-checkbox=on&' .
            'group-2-2-private-text=My%20group%202%20inner%20group%202%20private%20text%20value&' .
            'group-1-url-1=https%3A%2F%2Fexample.com%2F&' .
            'group-2-3-text=My%20group%202%20inner%20group%203%20text%20value&' .
            'group-2-3-checkbox=on&' .
            'group-2-3-private-text=My%20group%202%20inner%20group%203%20private%20text%20value&' .
            'group-3-text=My%20group%203%20text%20value&' .
            'group-3-checkbox=on&' .
            'group-3-private-text=My%20group%203%20private%20text%20value&' .
            'group-4-text=My%20group%204%20text%20value&' .
            'group-4-checkbox=on&' .
            'group-4-private-text=My%20group%204%20private%20text%20value&' .
            'default-value=A%20new%20value'
        );

        $form = new BasicTestGetForm(true);
        $isProcessed = $form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $form->getEventMethodsCalled());
        self::assertTrue($form->hasError());
        self::assertSame(
            [
                $form->getNotRequiredField(),
                $form->getCustomValidatedField(),
                $form->getTextField(),
                $form->getPasswordField(),
                $form->getNameField(),
                $form->getUrlField(),
                $form->getCheckBox(),
                $form->getTextArea(),
                $form->getSelect(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getOuterFormElementGroup(),
                $form->getOuterFormElementGroup()->getTextField1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox(),
                $form->getOuterFormElementGroup()->getTextField2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField(),
                $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox(),
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getTextField(),
                $form->getPrivateFormElementGroup1()->getCheckBox(),
            ],
            $form->getProcessedElements()
        );
        self::assertTrue($form->isProcessed());

        self::assertSame('', $form->getNotRequiredField()->getValue());
        self::assertFalse($form->getNotRequiredField()->hasError());

        self::assertSame('', $form->getCustomValidatedField()->getValue());
        self::assertTrue($form->getCustomValidatedField()->hasError());
        self::assertSame('Missing value', $form->getCustomValidatedField()->getError());

        self::assertSame('', $form->getTextField()->getValue());
        self::assertTrue($form->getTextField()->hasError());
        self::assertSame('Value of text field is empty.', $form->getTextField()->getError());

        self::assertSame('', $form->getPasswordField()->getValue());
        self::assertTrue($form->getPasswordField()->hasError());
        self::assertSame('Missing value', $form->getPasswordField()->getError());

        self::assertSame('', $form->getNameField()->getValue());
        self::assertTrue($form->getNameField()->hasError());
        self::assertSame('Missing value', $form->getNameField()->getError());

        self::assertNull($form->getUrlField()->getValue());
        self::assertTrue($form->getUrlField()->hasError());
        self::assertSame('Missing value', $form->getUrlField()->getError());

        self::assertFalse($form->getCheckBox()->getValue());
        self::assertTrue($form->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getCheckBox()->getError());

        self::assertSame('', $form->getTextArea()->getValue());
        self::assertTrue($form->getTextArea()->hasError());
        self::assertSame('Missing value', $form->getTextArea()->getError());

        self::assertSame('', $form->getSelect()->getValue());
        self::assertTrue($form->getSelect()->hasError());
        self::assertSame('Missing value', $form->getSelect()->getError());

        self::assertNull($form->getEmailField()->getValue());
        self::assertTrue($form->getEmailField()->hasError());
        self::assertSame('Missing value', $form->getEmailField()->getError());

        self::assertSame('', $form->getHiddenField()->getValue());
        self::assertTrue($form->getHiddenField()->hasError());
        self::assertSame('Missing value', $form->getHiddenField()->getError());

        self::assertNull($form->getIntegerField()->getValue());
        self::assertTrue($form->getIntegerField()->hasError());
        self::assertSame('Missing value', $form->getIntegerField()->getError());

        self::assertNull($form->getDateField()->getValue());
        self::assertTrue($form->getDateField()->hasError());
        self::assertSame('Missing value', $form->getDateField()->getError());

        self::assertSame('', $form->getRadioButtons()->getValue());
        self::assertTrue($form->getRadioButtons()->hasError());
        self::assertSame('Missing value', $form->getRadioButtons()->getError());

        self::assertNull($form->getDateTimeField()->getValue());
        self::assertTrue($form->getDateTimeField()->hasError());
        self::assertSame('Missing value', $form->getDateTimeField()->getError());

        self::assertSame('', $form->getPrivateField1()->getValue());
        self::assertTrue($form->getPrivateField1()->hasError());
        self::assertSame('Missing value', $form->getPrivateField1()->getError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField1()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getTextField1()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getTextField1()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getTextField2()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getTextField2()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getTextField2()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup1()->getTextField()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup1()->getCheckBox()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup2()->getTextField()->getError());

        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getValue());
        self::assertTrue($form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getOuterFormElementGroup()->getFormElementGroup2()->getCheckBox()->getError());

        self::assertSame('', $form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertNull($form->getOuterFormElementGroup()->getPrivateUrlField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateUrlField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getTextField()->hasError());

        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getCheckBox()->hasError());

        self::assertSame('', $form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->getValue());
        self::assertFalse($form->getOuterFormElementGroup()->getPrivateFormElementGroup()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getTextField()->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getTextField()->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getTextField()->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getCheckBox()->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getCheckBox()->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getCheckBox()->getError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getPrivateTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getTextField()->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getCheckBox()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getPrivateTextField()->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getPrivateTextField()->hasError());

        self::assertSame('This is the default value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }
}
