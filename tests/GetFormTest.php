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

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame([], $this->form->getEventMethodsCalled());
        self::assertFalse($this->form->hasError());
        self::assertSame([], $this->form->getProcessedElements());
        self::assertFalse($this->form->isProcessed());

        self::assertSame('', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('', $this->form->getCustomValidatedField()->getValue());
        self::assertFalse($this->form->getCustomValidatedField()->hasError());

        self::assertSame('', $this->form->getTextField()->getValue());
        self::assertFalse($this->form->getTextField()->hasError());

        self::assertSame('', $this->form->getPasswordField()->getValue());
        self::assertFalse($this->form->getPasswordField()->hasError());

        self::assertSame('', $this->form->getNameField()->getValue());
        self::assertFalse($this->form->getNameField()->hasError());

        self::assertSame(null, $this->form->getUrlField()->getValue());
        self::assertFalse($this->form->getUrlField()->hasError());

        self::assertSame(false, $this->form->getCheckBox()->getValue());
        self::assertFalse($this->form->getCheckBox()->hasError());

        self::assertSame('', $this->form->getTextArea()->getValue());
        self::assertFalse($this->form->getTextArea()->hasError());

        self::assertSame('', $this->form->getSelect()->getValue());
        self::assertFalse($this->form->getSelect()->hasError());

        self::assertNull($this->form->getEmailField()->getValue());
        self::assertFalse($this->form->getEmailField()->hasError());

        self::assertSame('', $this->form->getHiddenField()->getValue());
        self::assertFalse($this->form->getHiddenField()->hasError());

        self::assertNull($this->form->getIntegerField()->getValue());
        self::assertFalse($this->form->getIntegerField()->hasError());

        self::assertNull($this->form->getDateField()->getValue());
        self::assertFalse($this->form->getDateField()->hasError());

        self::assertSame('', $this->form->getRadioButtons()->getValue());
        self::assertFalse($this->form->getRadioButtons()->hasError());

        self::assertNull($this->form->getDateTimeField()->getValue());
        self::assertFalse($this->form->getDateTimeField()->hasError());

        self::assertSame('', $this->form->getPrivateField1()->getValue());
        self::assertFalse($this->form->getPrivateField1()->hasError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());

        self::assertSame('', $this->form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getFormElementGroup()->getElements()[0]->hasError());

        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->hasError());

        self::assertSame('', $this->form->getPrivateFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[0]->hasError());

        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->hasError());
    }

    /**
     * Test process with post request.
     */
    public function testProcessWithPostRequest()
    {
        $request = new FakeRequest('/', 'POST');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame([], $this->form->getEventMethodsCalled());
        self::assertFalse($this->form->hasError());
        self::assertSame([], $this->form->getProcessedElements());
        self::assertFalse($this->form->isProcessed());

        self::assertSame('', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('', $this->form->getCustomValidatedField()->getValue());
        self::assertFalse($this->form->getCustomValidatedField()->hasError());

        self::assertSame('', $this->form->getTextField()->getValue());
        self::assertFalse($this->form->getTextField()->hasError());

        self::assertSame('', $this->form->getPasswordField()->getValue());
        self::assertFalse($this->form->getPasswordField()->hasError());

        self::assertSame('', $this->form->getNameField()->getValue());
        self::assertFalse($this->form->getNameField()->hasError());

        self::assertSame(null, $this->form->getUrlField()->getValue());
        self::assertFalse($this->form->getUrlField()->hasError());

        self::assertSame(false, $this->form->getCheckBox()->getValue());
        self::assertFalse($this->form->getCheckBox()->hasError());

        self::assertSame('', $this->form->getTextArea()->getValue());
        self::assertFalse($this->form->getTextArea()->hasError());

        self::assertSame('', $this->form->getSelect()->getValue());
        self::assertFalse($this->form->getSelect()->hasError());

        self::assertNull($this->form->getEmailField()->getValue());
        self::assertFalse($this->form->getEmailField()->hasError());

        self::assertSame('', $this->form->getHiddenField()->getValue());
        self::assertFalse($this->form->getHiddenField()->hasError());

        self::assertNull($this->form->getIntegerField()->getValue());
        self::assertFalse($this->form->getIntegerField()->hasError());

        self::assertNull($this->form->getDateField()->getValue());
        self::assertFalse($this->form->getDateField()->hasError());

        self::assertSame('', $this->form->getRadioButtons()->getValue());
        self::assertFalse($this->form->getRadioButtons()->hasError());

        self::assertNull($this->form->getDateTimeField()->getValue());
        self::assertFalse($this->form->getDateTimeField()->hasError());

        self::assertSame('', $this->form->getPrivateField1()->getValue());
        self::assertFalse($this->form->getPrivateField1()->hasError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());

        self::assertSame('', $this->form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getFormElementGroup()->getElements()[0]->hasError());

        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->hasError());

        self::assertSame('', $this->form->getPrivateFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[0]->hasError());

        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->hasError());
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
            'group-text=My%20group%20text%20value&' .
            'group-checkbox=on&' .
            'private-group-text=My%20private%20group%20text%20value&' .
            'private-group-checkbox=on'
        );

        $isProcessed = $this->form->process($request);

        self::assertTrue($isProcessed);
        self::assertSame(['onValidate', 'onSuccess', 'onProcessed'], $this->form->getEventMethodsCalled());
        self::assertFalse($this->form->hasError());
        self::assertSame(
            [
                $this->form->getNotRequiredField(),
                $this->form->getCustomValidatedField(),
                $this->form->getTextField(),
                $this->form->getPasswordField(),
                $this->form->getNameField(),
                $this->form->getUrlField(),
                $this->form->getCheckBox(),
                $this->form->getTextArea(),
                $this->form->getSelect(),
                $this->form->getEmailField(),
                $this->form->getHiddenField(),
                $this->form->getIntegerField(),
                $this->form->getDateField(),
                $this->form->getRadioButtons(),
                $this->form->getDateTimeField(),
                $this->form->getFormElementGroup()->getElements()[0],
                $this->form->getFormElementGroup()->getElements()[1],
                $this->form->getPrivateField1(),
            ],
            $this->form->getProcessedElements()
        );
        self::assertTrue($this->form->isProcessed());

        self::assertSame('My not required value', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('My custom validated value', $this->form->getCustomValidatedField()->getValue());
        self::assertFalse($this->form->getCustomValidatedField()->hasError());

        self::assertSame('My text value', $this->form->getTextField()->getValue());
        self::assertFalse($this->form->getTextField()->hasError());

        self::assertSame('My password', $this->form->getPasswordField()->getValue());
        self::assertFalse($this->form->getPasswordField()->hasError());

        self::assertSame('My Name', $this->form->getNameField()->getValue());
        self::assertFalse($this->form->getNameField()->hasError());

        self::assertSame('https://domain.com/foo', $this->form->getUrlField()->getValue()->__toString());
        self::assertFalse($this->form->getUrlField()->hasError());

        self::assertTrue($this->form->getCheckBox()->getValue());
        self::assertFalse($this->form->getCheckBox()->hasError());

        self::assertSame("My\r\nText", $this->form->getTextArea()->getValue());
        self::assertFalse($this->form->getTextArea()->hasError());

        self::assertSame('bar', $this->form->getSelect()->getValue());
        self::assertFalse($this->form->getSelect()->hasError());

        self::assertSame('foo.bar@example.com', $this->form->getEmailField()->getValue()->__toString());
        self::assertFalse($this->form->getEmailField()->hasError());

        self::assertSame('My hidden value', $this->form->getHiddenField()->getValue());
        self::assertFalse($this->form->getHiddenField()->hasError());

        self::assertSame(12345, $this->form->getIntegerField()->getValue());
        self::assertFalse($this->form->getIntegerField()->hasError());

        self::assertSame('2017-10-15 00:00:00', $this->form->getDateField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($this->form->getDateField()->hasError());

        self::assertSame('foo', $this->form->getRadioButtons()->getValue());
        self::assertFalse($this->form->getRadioButtons()->hasError());

        self::assertSame('2017-12-01 10:20:00', $this->form->getDateTimeField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($this->form->getDateTimeField()->hasError());

        self::assertSame('0', $this->form->getPrivateField1()->getValue());
        self::assertFalse($this->form->getPrivateField1()->hasError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());

        self::assertSame('My group text value', $this->form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getFormElementGroup()->getElements()[0]->hasError());

        self::assertTrue($this->form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->hasError());

        self::assertSame('', $this->form->getPrivateFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[0]->hasError());

        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->hasError());
    }

    /**
     * Test process with empty get request.
     */
    public function testProcessWithEmptyGetRequest()
    {
        $request = new FakeRequest('/?');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $this->form->getEventMethodsCalled());
        self::assertTrue($this->form->hasError());
        self::assertSame(
            [
                $this->form->getNotRequiredField(),
                $this->form->getCustomValidatedField(),
                $this->form->getTextField(),
                $this->form->getPasswordField(),
                $this->form->getNameField(),
                $this->form->getUrlField(),
                $this->form->getCheckBox(),
                $this->form->getTextArea(),
                $this->form->getSelect(),
                $this->form->getEmailField(),
                $this->form->getHiddenField(),
                $this->form->getIntegerField(),
                $this->form->getDateField(),
                $this->form->getRadioButtons(),
                $this->form->getDateTimeField(),
                $this->form->getFormElementGroup()->getElements()[0],
                $this->form->getFormElementGroup()->getElements()[1],
                $this->form->getPrivateField1(),
            ],
            $this->form->getProcessedElements()
        );
        self::assertTrue($this->form->isProcessed());

        self::assertSame('', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('', $this->form->getCustomValidatedField()->getValue());
        self::assertTrue($this->form->getCustomValidatedField()->hasError());
        self::assertSame('Missing value', $this->form->getCustomValidatedField()->getError());

        self::assertSame('', $this->form->getTextField()->getValue());
        self::assertTrue($this->form->getTextField()->hasError());
        self::assertSame('Missing value', $this->form->getTextField()->getError());

        self::assertSame('', $this->form->getPasswordField()->getValue());
        self::assertTrue($this->form->getPasswordField()->hasError());
        self::assertSame('Missing value', $this->form->getPasswordField()->getError());

        self::assertSame('', $this->form->getNameField()->getValue());
        self::assertTrue($this->form->getNameField()->hasError());
        self::assertSame('Missing value', $this->form->getNameField()->getError());

        self::assertNull($this->form->getUrlField()->getValue());
        self::assertTrue($this->form->getUrlField()->hasError());
        self::assertSame('Missing value', $this->form->getUrlField()->getError());

        self::assertFalse($this->form->getCheckBox()->getValue());
        self::assertTrue($this->form->getCheckBox()->hasError());
        self::assertSame('Missing value', $this->form->getCheckBox()->getError());

        self::assertSame('', $this->form->getTextArea()->getValue());
        self::assertTrue($this->form->getTextArea()->hasError());
        self::assertSame('Missing value', $this->form->getTextArea()->getError());

        self::assertSame('', $this->form->getSelect()->getValue());
        self::assertTrue($this->form->getSelect()->hasError());
        self::assertSame('Missing value', $this->form->getSelect()->getError());

        self::assertNull($this->form->getEmailField()->getValue());
        self::assertTrue($this->form->getEmailField()->hasError());
        self::assertSame('Missing value', $this->form->getEmailField()->getError());

        self::assertSame('', $this->form->getHiddenField()->getValue());
        self::assertTrue($this->form->getHiddenField()->hasError());
        self::assertSame('Missing value', $this->form->getHiddenField()->getError());

        self::assertNull($this->form->getIntegerField()->getValue());
        self::assertTrue($this->form->getIntegerField()->hasError());
        self::assertSame('Missing value', $this->form->getIntegerField()->getError());

        self::assertNull($this->form->getDateField()->getValue());
        self::assertTrue($this->form->getDateField()->hasError());
        self::assertSame('Missing value', $this->form->getDateField()->getError());

        self::assertSame('', $this->form->getRadioButtons()->getValue());
        self::assertTrue($this->form->getRadioButtons()->hasError());
        self::assertSame('Missing value', $this->form->getRadioButtons()->getError());

        self::assertNull($this->form->getDateTimeField()->getValue());
        self::assertTrue($this->form->getDateTimeField()->hasError());
        self::assertSame('Missing value', $this->form->getDateTimeField()->getError());

        self::assertSame('', $this->form->getPrivateField1()->getValue());
        self::assertTrue($this->form->getPrivateField1()->hasError());
        self::assertSame('Missing value', $this->form->getPrivateField1()->getError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());
        self::assertNull($this->form->getPrivateField2()->getError());

        self::assertSame('', $this->form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertTrue($this->form->getFormElementGroup()->getElements()[0]->hasError());
        self::assertSame('Missing value', $this->form->getFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertTrue($this->form->getFormElementGroup()->getElements()[1]->hasError());
        self::assertSame('Missing value', $this->form->getFormElementGroup()->getElements()[1]->getError());

        self::assertSame('', $this->form->getPrivateFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[0]->hasError());
        self::assertNull($this->form->getPrivateFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->hasError());
        self::assertNull($this->form->getPrivateFormElementGroup()->getElements()[1]->getError());
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
            'group-text=invalid&' .
            'group-checkbox=invalid&' .
            'private-group-text=invalid&' .
            'private-group-checkbox=invalid'
        );

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $this->form->getEventMethodsCalled());
        self::assertTrue($this->form->hasError());
        self::assertSame(
            [
                $this->form->getNotRequiredField(),
                $this->form->getCustomValidatedField(),
                $this->form->getTextField(),
                $this->form->getPasswordField(),
                $this->form->getNameField(),
                $this->form->getUrlField(),
                $this->form->getCheckBox(),
                $this->form->getTextArea(),
                $this->form->getSelect(),
                $this->form->getEmailField(),
                $this->form->getHiddenField(),
                $this->form->getIntegerField(),
                $this->form->getDateField(),
                $this->form->getRadioButtons(),
                $this->form->getDateTimeField(),
                $this->form->getFormElementGroup()->getElements()[0],
                $this->form->getFormElementGroup()->getElements()[1],
                $this->form->getPrivateField1(),
            ],
            $this->form->getProcessedElements()
        );
        self::assertTrue($this->form->isProcessed());

        self::assertSame('invalid', $this->form->getNotRequiredField()->getValue());
        self::assertTrue($this->form->getNotRequiredField()->hasError());
        self::assertSame('Value of not required field is invalid.', $this->form->getNotRequiredField()->getError());

        self::assertSame('invalid', $this->form->getCustomValidatedField()->getValue());
        self::assertTrue($this->form->getCustomValidatedField()->hasError());
        self::assertSame('Value of custom validated field is invalid.', $this->form->getCustomValidatedField()->getError());

        self::assertSame('invalid', $this->form->getTextField()->getValue());
        self::assertTrue($this->form->getTextField()->hasError());
        self::assertSame('Value of text field is invalid.', $this->form->getTextField()->getError());

        self::assertSame('invalid', $this->form->getPasswordField()->getValue());
        self::assertTrue($this->form->getPasswordField()->hasError());
        self::assertSame('Value of password field is invalid.', $this->form->getPasswordField()->getError());

        self::assertSame('Invalid', $this->form->getNameField()->getValue());
        self::assertTrue($this->form->getNameField()->hasError());
        self::assertSame('Value of name field is invalid.', $this->form->getNameField()->getError());

        self::assertNull($this->form->getUrlField()->getValue());
        self::assertTrue($this->form->getUrlField()->hasError());
        self::assertSame('Invalid value', $this->form->getUrlField()->getError());

        self::assertFalse($this->form->getCheckBox()->getValue());
        self::assertTrue($this->form->getCheckBox()->hasError());
        self::assertSame('Missing value', $this->form->getCheckBox()->getError());

        self::assertSame('invalid', $this->form->getTextArea()->getValue());
        self::assertTrue($this->form->getTextArea()->hasError());
        self::assertSame('Value of text area is invalid.', $this->form->getTextArea()->getError());

        self::assertSame('', $this->form->getSelect()->getValue());
        self::assertTrue($this->form->getSelect()->hasError());
        self::assertSame('Missing value', $this->form->getSelect()->getError());

        self::assertNull($this->form->getEmailField()->getValue());
        self::assertTrue($this->form->getEmailField()->hasError());
        self::assertSame('Invalid value', $this->form->getEmailField()->getError());

        self::assertSame('invalid', $this->form->getHiddenField()->getValue());
        self::assertTrue($this->form->getHiddenField()->hasError());
        self::assertSame('Value of hidden field is invalid.', $this->form->getHiddenField()->getError());

        self::assertNull($this->form->getIntegerField()->getValue());
        self::assertTrue($this->form->getIntegerField()->hasError());
        self::assertSame('Invalid value', $this->form->getIntegerField()->getError());

        self::assertNull($this->form->getDateField()->getValue());
        self::assertTrue($this->form->getDateField()->hasError());
        self::assertSame('Invalid value', $this->form->getDateField()->getError());

        self::assertSame('', $this->form->getRadioButtons()->getValue());
        self::assertTrue($this->form->getRadioButtons()->hasError());
        self::assertSame('Missing value', $this->form->getRadioButtons()->getError());

        self::assertNull($this->form->getDateTimeField()->getValue());
        self::assertTrue($this->form->getDateTimeField()->hasError());
        self::assertSame('Invalid value', $this->form->getDateTimeField()->getError());

        self::assertSame('invalid', $this->form->getPrivateField1()->getValue());
        self::assertTrue($this->form->getPrivateField1()->hasError());
        self::assertSame('Value of private field 1 is invalid.', $this->form->getPrivateField1()->getError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());
        self::assertNull($this->form->getPrivateField2()->getError());

        self::assertSame('invalid', $this->form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertTrue($this->form->getFormElementGroup()->getElements()[0]->hasError());
        self::assertSame('Value of group text is invalid', $this->form->getFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($this->form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertTrue($this->form->getFormElementGroup()->getElements()[1]->hasError());
        self::assertSame('Missing value', $this->form->getFormElementGroup()->getElements()[1]->getError());

        self::assertSame('', $this->form->getPrivateFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[0]->hasError());
        self::assertNull($this->form->getPrivateFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($this->form->getPrivateFormElementGroup()->getElements()[1]->hasError());
        self::assertNull($this->form->getPrivateFormElementGroup()->getElements()[1]->getError());
    }

    /**
     * Set up.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->form = new BasicTestGetForm();
    }

    /**
     * Tear down.
     */
    public function tearDown(): void
    {
        parent::tearDown();

        $this->form = null;
    }

    /**
     * @var BasicTestGetForm My form.
     */
    private $form;
}
