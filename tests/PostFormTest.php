<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\BasicTestPostForm;
use PHPUnit\Framework\TestCase;

/**
 * Test PostForm class.
 */
class PostFormTest extends TestCase
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

        self::assertNull($this->form->getFileField()->getFile());
        self::assertFalse($this->form->getFileField()->hasError());

        self::assertNull($this->form->getEmailField()->getValue());
        self::assertFalse($this->form->getEmailField()->hasError());

        self::assertSame('', $this->form->getHiddenField()->getValue());
        self::assertFalse($this->form->getHiddenField()->hasError());

        self::assertNull($this->form->getIntegerField()->getValue());
        self::assertFalse($this->form->getIntegerField()->hasError());

        self::assertNull($this->form->getDateField()->getValue());
        self::assertFalse($this->form->getDateField()->hasError());

        self::assertNull($this->form->getJsonFileField()->getFile());
        self::assertSame([], $this->form->getJsonFileField()->getJson());
        self::assertFalse($this->form->getJsonFileField()->hasError());

        self::assertSame('', $this->form->getRadioButtons()->getValue());
        self::assertFalse($this->form->getRadioButtons()->hasError());

        self::assertNull($this->form->getDateTimeField()->getValue());
        self::assertFalse($this->form->getDateTimeField()->hasError());

        self::assertSame('', $this->form->getPrivateField1()->getValue());
        self::assertFalse($this->form->getPrivateField1()->hasError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());
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
        $request->setFormParameter('select', 'bar');
        $request->uploadFile('file', __DIR__ . '/Helpers/TestFiles/file.txt');
        $request->setFormParameter('email', 'foo.bar@example.com');
        $request->setFormParameter('hidden', 'My hidden value');
        $request->setFormParameter('integer', '12345');
        $request->setFormParameter('date', '2017-10-15');
        $request->uploadFile('json', __DIR__ . '/Helpers/TestFiles/file.json');
        $request->setFormParameter('radio', 'foo');
        $request->setFormParameter('datetime', '2017-12-01 10:20:30');
        $request->setFormParameter('private-1', '0');
        $request->setFormParameter('private-2', 'My private field 2 value');

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
                $this->form->getFileField(),
                $this->form->getEmailField(),
                $this->form->getHiddenField(),
                $this->form->getIntegerField(),
                $this->form->getDateField(),
                $this->form->getJsonFileField(),
                $this->form->getRadioButtons(),
                $this->form->getDateTimeField(),
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

        self::assertSame('Hello World!', file_get_contents($this->form->getFileField()->getFile()->getPath()->__toString()));
        self::assertSame('file.txt', basename($this->form->getFileField()->getFile()->getOriginalName()));
        self::assertSame(12, $this->form->getFileField()->getFile()->getSize());
        self::assertFalse($this->form->getFileField()->hasError());

        self::assertSame('foo.bar@example.com', $this->form->getEmailField()->getValue()->__toString());
        self::assertFalse($this->form->getEmailField()->hasError());

        self::assertSame('My hidden value', $this->form->getHiddenField()->getValue());
        self::assertFalse($this->form->getHiddenField()->hasError());

        self::assertSame(12345, $this->form->getIntegerField()->getValue());
        self::assertFalse($this->form->getIntegerField()->hasError());

        self::assertSame('2017-10-15 00:00:00', $this->form->getDateField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($this->form->getDateField()->hasError());

        self::assertSame('{"Foo": "Bar"}', file_get_contents($this->form->getJsonFileField()->getFile()->getPath()->__toString()));
        self::assertSame('file.json', basename($this->form->getJsonFileField()->getFile()->getOriginalName()));
        self::assertSame(14, $this->form->getJsonFileField()->getFile()->getSize());
        self::assertSame(['Foo' => 'Bar'], $this->form->getJsonFileField()->getJson());
        self::assertFalse($this->form->getJsonFileField()->hasError());

        self::assertSame('foo', $this->form->getRadioButtons()->getValue());
        self::assertFalse($this->form->getRadioButtons()->hasError());

        self::assertSame('2017-12-01 10:20:00', $this->form->getDateTimeField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($this->form->getDateTimeField()->hasError());

        self::assertSame('0', $this->form->getPrivateField1()->getValue());
        self::assertFalse($this->form->getPrivateField1()->hasError());

        self::assertSame('', $this->form->getPrivateField2()->getValue());
        self::assertFalse($this->form->getPrivateField2()->hasError());
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
                $this->form->getFileField(),
                $this->form->getEmailField(),
                $this->form->getHiddenField(),
                $this->form->getIntegerField(),
                $this->form->getDateField(),
                $this->form->getJsonFileField(),
                $this->form->getRadioButtons(),
                $this->form->getDateTimeField(),
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

        self::assertNull($this->form->getFileField()->getFile());
        self::assertTrue($this->form->getFileField()->hasError());
        self::assertSame('Missing file', $this->form->getFileField()->getError());

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

        self::assertNull($this->form->getJsonFileField()->getFile());
        self::assertSame([], $this->form->getJsonFileField()->getJson());
        self::assertTrue($this->form->getJsonFileField()->hasError());
        self::assertSame('Missing file', $this->form->getJsonFileField()->getError());

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
        $request->setFormParameter('select', 'baz');
        $request->uploadFile('file', __DIR__ . '/Helpers/TestFiles/invalid-file.txt');
        $request->setFormParameter('email', 'invalid');
        $request->setFormParameter('hidden', 'invalid');
        $request->setFormParameter('integer', 'invalid');
        $request->setFormParameter('date', 'invalid');
        $request->uploadFile('json', __DIR__ . '/Helpers/TestFiles/file.txt');
        $request->setFormParameter('radio', 'baz');
        $request->setFormParameter('datetime', 'invalid');
        $request->setFormParameter('private-1', 'invalid');
        $request->setFormParameter('private-2', 'invalid');

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
                $this->form->getFileField(),
                $this->form->getEmailField(),
                $this->form->getHiddenField(),
                $this->form->getIntegerField(),
                $this->form->getDateField(),
                $this->form->getJsonFileField(),
                $this->form->getRadioButtons(),
                $this->form->getDateTimeField(),
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

        self::assertSame('This is an invalid file!', file_get_contents($this->form->getFileField()->getFile()->getPath()->__toString()));
        self::assertSame('invalid-file.txt', basename($this->form->getFileField()->getFile()->getOriginalName()));
        self::assertSame(24, $this->form->getFileField()->getFile()->getSize());
        self::assertTrue($this->form->getFileField()->hasError());
        self::assertSame('File content is invalid.', $this->form->getFileField()->getError());

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

        self::assertSame('Hello World!', file_get_contents($this->form->getJsonFileField()->getFile()->getPath()->__toString()));
        self::assertSame('file.txt', basename($this->form->getJsonFileField()->getFile()->getOriginalName()));
        self::assertSame(12, $this->form->getJsonFileField()->getFile()->getSize());
        self::assertSame([], $this->form->getJsonFileField()->getJson());
        self::assertTrue($this->form->getJsonFileField()->hasError());
        self::assertSame('Invalid json content.', $this->form->getJsonFileField()->getError());

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
