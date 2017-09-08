<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\BasicTestPostForm;

/**
 * Test PostForm class.
 */
class PostFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test process with get request.
     */
    public function testProcessWithGetRequest()
    {
        $request = new FakeRequest('/', 'GET');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame([], $this->form->getEventMethodsCalled());

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
    }

    /**
     * Test process with post request.
     */
    public function testProcessWithPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('not-required', 'My not required value');
        $request->setFormParameter('custom-validated', 'My custom validated value');
        $request->setFormParameter('text', 'My text value');
        $request->setFormParameter('password', 'My password');
        $request->setFormParameter('name', 'My name');
        $request->setFormParameter('url', 'https://domain.com/foo');
        $request->setFormParameter('checkbox', 'on');
        $request->setFormParameter('textarea', "My\nText");

        $isProcessed = $this->form->process($request);

        self::assertTrue($isProcessed);
        self::assertSame(['onValidate', 'onSuccess', 'onProcessed'], $this->form->getEventMethodsCalled());

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

        self::assertSame("My\nText", $this->form->getTextArea()->getValue());
        self::assertFalse($this->form->getTextArea()->hasError());
    }

    /**
     * Test process with empty post request.
     */
    public function testProcessWithEmptyPostRequest()
    {
        $request = new FakeRequest('/', 'POST');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $this->form->getEventMethodsCalled());

        self::assertSame('', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('', $this->form->getCustomValidatedField()->getValue());
        self::assertTrue($this->form->getCustomValidatedField()->hasError());
        self::assertSame('Value is required.', $this->form->getCustomValidatedField()->getError());

        self::assertSame('', $this->form->getTextField()->getValue());
        self::assertTrue($this->form->getTextField()->hasError());
        self::assertSame('Value is required.', $this->form->getTextField()->getError());

        self::assertSame('', $this->form->getPasswordField()->getValue());
        self::assertTrue($this->form->getPasswordField()->hasError());
        self::assertSame('Value is required.', $this->form->getPasswordField()->getError());

        self::assertSame('', $this->form->getNameField()->getValue());
        self::assertTrue($this->form->getNameField()->hasError());
        self::assertSame('Value is required.', $this->form->getNameField()->getError());

        self::assertNull($this->form->getUrlField()->getValue());
        self::assertTrue($this->form->getUrlField()->hasError());
        self::assertSame('Value is required.', $this->form->getUrlField()->getError());

        self::assertFalse($this->form->getCheckBox()->getValue());
        self::assertTrue($this->form->getCheckBox()->hasError());
        self::assertSame('Value is required.', $this->form->getCheckBox()->getError());

        self::assertSame('', $this->form->getTextArea()->getValue());
        self::assertTrue($this->form->getTextArea()->hasError());
        self::assertSame('Value is required.', $this->form->getTextArea()->getError());
    }

    /**
     * Test process with invalid values in post request.
     */
    public function testProcessWithInvalidValuesInPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('not-required', 'invalid');
        $request->setFormParameter('custom-validated', 'invalid');
        $request->setFormParameter('text', 'invalid');
        $request->setFormParameter('password', 'invalid');
        $request->setFormParameter('name', 'invalid');
        $request->setFormParameter('url', 'invalid');
        $request->setFormParameter('checkbox', 'invalid');
        $request->setFormParameter('textarea', 'invalid');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);
        self::assertSame(['onValidate', 'onError', 'onProcessed'], $this->form->getEventMethodsCalled());

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
        self::assertSame('Value is invalid.', $this->form->getUrlField()->getError());

        self::assertFalse($this->form->getCheckBox()->getValue());
        self::assertTrue($this->form->getCheckBox()->hasError());
        self::assertSame('Value is required.', $this->form->getCheckBox()->getError());

        self::assertSame('invalid', $this->form->getTextArea()->getValue());
        self::assertTrue($this->form->getTextArea()->hasError());
        self::assertSame('Value of text area is invalid.', $this->form->getTextArea()->getError());
    }

    /**
     * Set up.
     */
    public function setUp()
    {
        $this->form = new BasicTestPostForm();
    }

    /**
     * Tear down.
     */
    public function tearDown()
    {
        $this->form = null;
    }

    /**
     * @var BasicTestPostForm My form.
     */
    private $form;
}
