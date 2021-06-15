<?php

declare(strict_types=1);

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
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function testProcessWithGetRequest()
    {
        $request = new FakeRequest('/', 'GET');

        $form = new BasicTestPostForm();
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

        self::assertNull($form->getFileField()->getFile());
        self::assertFalse($form->getFileField()->hasError());

        self::assertNull($form->getEmailField()->getValue());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertNull($form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertNull($form->getDateField()->getValue());
        self::assertFalse($form->getDateField()->hasError());

        self::assertNull($form->getJsonFileField()->getFile());
        self::assertSame([], $form->getJsonFileField()->getJson());
        self::assertFalse($form->getJsonFileField()->hasError());

        self::assertSame('', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertNull($form->getDateTimeField()->getValue());
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertFalse($form->getFormElementGroup()->hasError());

        self::assertSame('', $form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($form->getFormElementGroup()->getElements()[0]->hasError());

        self::assertFalse($form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($form->getFormElementGroup()->getElements()[1]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[0]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[0]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->hasError());

        self::assertSame('This is the default value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with post request.
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
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
        $request->setFormParameter('group-text', 'My group text value');
        $request->setFormParameter('group-checkbox', 'on');
        $request->setFormParameter('private-group-text-1', 'My private group 1 text value');
        $request->setFormParameter('private-group-checkbox-1', 'on');
        $request->setFormParameter('private-group-text-2', 'My private group 2 text value');
        $request->setFormParameter('private-group-checkbox-2', 'on');
        $request->setFormParameter('default-value', 'A new value');

        $form = new BasicTestPostForm();
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
                $form->getFileField(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getJsonFileField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getFormElementGroup(),
                $form->getFormElementGroup()->getElements()[0],
                $form->getFormElementGroup()->getElements()[1],
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getElements()[0],
                $form->getPrivateFormElementGroup1()->getElements()[1],
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

        $testTextFileContent = file_get_contents($form->getFileField()->getFile()->getPath()->__toString());
        self::assertSame("Hello World!\n", self::normalizeEndOfLine($testTextFileContent));
        self::assertSame('file.txt', basename($form->getFileField()->getFile()->getOriginalName()));
        self::assertSame(strlen($testTextFileContent), $form->getFileField()->getFile()->getSize());
        self::assertFalse($form->getFileField()->hasError());

        self::assertSame('foo.bar@example.com', $form->getEmailField()->getValue()->__toString());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('My hidden value', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertSame(12345, $form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertSame('2017-10-15 00:00:00', $form->getDateField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateField()->hasError());

        $testJsonFileContent = file_get_contents($form->getJsonFileField()->getFile()->getPath()->__toString());
        self::assertSame("{\"Foo\": \"Bar\"}\n", self::normalizeEndOfLine($testJsonFileContent));
        self::assertSame('file.json', basename($form->getJsonFileField()->getFile()->getOriginalName()));
        self::assertSame(strlen($testJsonFileContent), $form->getJsonFileField()->getFile()->getSize());
        self::assertSame(['Foo' => 'Bar'], $form->getJsonFileField()->getJson());
        self::assertFalse($form->getJsonFileField()->hasError());

        self::assertSame('foo', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertSame('2017-12-01 10:20:00', $form->getDateTimeField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('0', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertFalse($form->getFormElementGroup()->hasError());

        self::assertSame('My group text value', $form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($form->getFormElementGroup()->getElements()[0]->hasError());

        self::assertTrue($form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($form->getFormElementGroup()->getElements()[1]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('My private group 1 text value', $form->getPrivateFormElementGroup1()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[0]->hasError());

        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[0]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->hasError());

        self::assertSame('A new value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with empty post request.
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function testProcessWithEmptyPostRequest()
    {
        $request = new FakeRequest('/', 'POST');

        $form = new BasicTestPostForm();
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
                $form->getFileField(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getJsonFileField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getFormElementGroup(),
                $form->getFormElementGroup()->getElements()[0],
                $form->getFormElementGroup()->getElements()[1],
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getElements()[0],
                $form->getPrivateFormElementGroup1()->getElements()[1],
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

        self::assertNull($form->getFileField()->getFile());
        self::assertTrue($form->getFileField()->hasError());
        self::assertSame('Missing file', $form->getFileField()->getError());

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

        self::assertNull($form->getJsonFileField()->getFile());
        self::assertSame([], $form->getJsonFileField()->getJson());
        self::assertTrue($form->getJsonFileField()->hasError());
        self::assertSame('Missing file', $form->getJsonFileField()->getError());

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

        self::assertFalse($form->getFormElementGroup()->hasError());

        self::assertSame('', $form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertTrue($form->getFormElementGroup()->getElements()[0]->hasError());
        self::assertSame('Missing value', $form->getFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertTrue($form->getFormElementGroup()->getElements()[1]->hasError());
        self::assertSame('Missing value', $form->getFormElementGroup()->getElements()[1]->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getElements()[0]->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[0]->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getElements()[0]->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[1]->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getElements()[1]->getError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[0]->hasError());
        self::assertNull($form->getPrivateFormElementGroup2()->getElements()[0]->getError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->hasError());
        self::assertNull($form->getPrivateFormElementGroup2()->getElements()[1]->getError());

        self::assertSame('', $form->getDefaultValueElement()->getValue());
        self::assertTrue($form->getDefaultValueElement()->hasError());
        self::assertSame('Missing value', $form->getDefaultValueElement()->getError());
    }

    /**
     * Test process with invalid values in post request.
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
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
        $request->setFormParameter('group-text', 'invalid');
        $request->setFormParameter('group-checkbox', 'invalid');
        $request->setFormParameter('private-group-text-1', 'invalid');
        $request->setFormParameter('private-group-checkbox-1', 'invalid');
        $request->setFormParameter('private-group-text-2', 'invalid');
        $request->setFormParameter('private-group-checkbox-2', 'invalid');
        $request->setFormParameter('default-value', 'invalid');

        $form = new BasicTestPostForm();
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
                $form->getFileField(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getJsonFileField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getFormElementGroup(),
                $form->getFormElementGroup()->getElements()[0],
                $form->getFormElementGroup()->getElements()[1],
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getElements()[0],
                $form->getPrivateFormElementGroup1()->getElements()[1],
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

        $testTextFileContent = file_get_contents($form->getFileField()->getFile()->getPath()->__toString());
        self::assertSame("This is an invalid file!\n", self::normalizeEndOfLine($testTextFileContent));
        self::assertSame('invalid-file.txt', basename($form->getFileField()->getFile()->getOriginalName()));
        self::assertSame(strlen($testTextFileContent), $form->getFileField()->getFile()->getSize());
        self::assertTrue($form->getFileField()->hasError());
        self::assertSame('File content is invalid.', $form->getFileField()->getError());

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

        $testJsonFileContent = file_get_contents($form->getJsonFileField()->getFile()->getPath()->__toString());
        self::assertSame("Hello World!\n", self::normalizeEndOfLine($testJsonFileContent));
        self::assertSame('file.txt', basename($form->getJsonFileField()->getFile()->getOriginalName()));
        self::assertSame(strlen($testJsonFileContent), $form->getJsonFileField()->getFile()->getSize());
        self::assertSame([], $form->getJsonFileField()->getJson());
        self::assertTrue($form->getJsonFileField()->hasError());
        self::assertSame('Invalid json content.', $form->getJsonFileField()->getError());

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

        self::assertFalse($form->getFormElementGroup()->hasError());

        self::assertSame('invalid', $form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertTrue($form->getFormElementGroup()->getElements()[0]->hasError());
        self::assertSame('Value of group text is invalid', $form->getFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertTrue($form->getFormElementGroup()->getElements()[1]->hasError());
        self::assertSame('Missing value', $form->getFormElementGroup()->getElements()[1]->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('invalid', $form->getPrivateFormElementGroup1()->getElements()[0]->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[0]->hasError());
        self::assertSame('Value of private group 1 text is invalid', $form->getPrivateFormElementGroup1()->getElements()[0]->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[1]->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getElements()[1]->getError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[0]->hasError());
        self::assertNull($form->getPrivateFormElementGroup2()->getElements()[0]->getError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->hasError());
        self::assertNull($form->getPrivateFormElementGroup2()->getElements()[1]->getError());

        self::assertSame('invalid', $form->getDefaultValueElement()->getValue());
        self::assertTrue($form->getDefaultValueElement()->hasError());
        self::assertSame('Value is invalid.', $form->getDefaultValueElement()->getError());
    }

    /**
     * Test process with element group error.
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function testProcessWithElementGroupError()
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
        $request->setFormParameter('group-text', 'invalid-group');
        $request->setFormParameter('group-checkbox', 'on');
        $request->setFormParameter('private-group-text-1', 'invalid-group');
        $request->setFormParameter('private-group-checkbox-1', 'on');
        $request->setFormParameter('private-group-text-2', 'invalid-group');
        $request->setFormParameter('private-group-checkbox-2', 'on');
        $request->setFormParameter('default-value', 'A new value');

        $form = new BasicTestPostForm();
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
                $form->getFileField(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getJsonFileField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getFormElementGroup(),
                $form->getFormElementGroup()->getElements()[0],
                $form->getFormElementGroup()->getElements()[1],
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getElements()[0],
                $form->getPrivateFormElementGroup1()->getElements()[1],
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

        $testTextFileContent = file_get_contents($form->getFileField()->getFile()->getPath()->__toString());
        self::assertSame("Hello World!\n", self::normalizeEndOfLine($testTextFileContent));
        self::assertSame('file.txt', basename($form->getFileField()->getFile()->getOriginalName()));
        self::assertSame(strlen($testTextFileContent), $form->getFileField()->getFile()->getSize());
        self::assertFalse($form->getFileField()->hasError());

        self::assertSame('foo.bar@example.com', $form->getEmailField()->getValue()->__toString());
        self::assertFalse($form->getEmailField()->hasError());

        self::assertSame('My hidden value', $form->getHiddenField()->getValue());
        self::assertFalse($form->getHiddenField()->hasError());

        self::assertSame(12345, $form->getIntegerField()->getValue());
        self::assertFalse($form->getIntegerField()->hasError());

        self::assertSame('2017-10-15 00:00:00', $form->getDateField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateField()->hasError());

        $testJsonFileContent = file_get_contents($form->getJsonFileField()->getFile()->getPath()->__toString());
        self::assertSame("{\"Foo\": \"Bar\"}\n", self::normalizeEndOfLine($testJsonFileContent));
        self::assertSame('file.json', basename($form->getJsonFileField()->getFile()->getOriginalName()));
        self::assertSame(strlen($testJsonFileContent), $form->getJsonFileField()->getFile()->getSize());
        self::assertSame(['Foo' => 'Bar'], $form->getJsonFileField()->getJson());
        self::assertFalse($form->getJsonFileField()->hasError());

        self::assertSame('foo', $form->getRadioButtons()->getValue());
        self::assertFalse($form->getRadioButtons()->hasError());

        self::assertSame('2017-12-01 10:20:00', $form->getDateTimeField()->getValue()->format('Y-m-d H:i:s'));
        self::assertFalse($form->getDateTimeField()->hasError());

        self::assertSame('0', $form->getPrivateField1()->getValue());
        self::assertFalse($form->getPrivateField1()->hasError());

        self::assertSame('', $form->getPrivateField2()->getValue());
        self::assertFalse($form->getPrivateField2()->hasError());

        self::assertTrue($form->getFormElementGroup()->hasError());
        self::assertSame('Group is invalid', $form->getFormElementGroup()->getError());

        self::assertSame('invalid-group', $form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertFalse($form->getFormElementGroup()->getElements()[0]->hasError());

        self::assertTrue($form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertFalse($form->getFormElementGroup()->getElements()[1]->hasError());

        self::assertTrue($form->getPrivateFormElementGroup1()->hasError());
        self::assertSame('Private group 1 is invalid', $form->getPrivateFormElementGroup1()->getError());

        self::assertSame('invalid-group', $form->getPrivateFormElementGroup1()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[0]->hasError());

        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[0]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->hasError());

        self::assertSame('A new value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Test process with elements disabled.
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function testProcessWithElementsDisabled()
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
        $request->setFormParameter('group-text', 'My group text value');
        $request->setFormParameter('group-checkbox', 'on');
        $request->setFormParameter('private-group-text-1', 'My private group 1 text value');
        $request->setFormParameter('private-group-checkbox-1', 'on');
        $request->setFormParameter('private-group-text-2', 'My private group 2 text value');
        $request->setFormParameter('private-group-checkbox-2', 'on');
        $request->setFormParameter('default-value', 'A new value');

        $form = new BasicTestPostForm(true);
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
                $form->getFileField(),
                $form->getEmailField(),
                $form->getHiddenField(),
                $form->getIntegerField(),
                $form->getDateField(),
                $form->getJsonFileField(),
                $form->getRadioButtons(),
                $form->getDateTimeField(),
                $form->getFormElementGroup(),
                $form->getFormElementGroup()->getElements()[0],
                $form->getFormElementGroup()->getElements()[1],
                $form->getDefaultValueElement(),
                $form->getPrivateField1(),
                $form->getPrivateFormElementGroup1(),
                $form->getPrivateFormElementGroup1()->getElements()[0],
                $form->getPrivateFormElementGroup1()->getElements()[1],
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

        self::assertNull($form->getFileField()->getFile());
        self::assertTrue($form->getFileField()->hasError());
        self::assertSame('Missing file', $form->getFileField()->getError());

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

        self::assertNull($form->getJsonFileField()->getFile());
        self::assertSame([], $form->getJsonFileField()->getJson());
        self::assertTrue($form->getJsonFileField()->hasError());
        self::assertSame('Missing file', $form->getJsonFileField()->getError());

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

        self::assertFalse($form->getFormElementGroup()->hasError());

        self::assertSame('', $form->getFormElementGroup()->getElements()[0]->getValue());
        self::assertTrue($form->getFormElementGroup()->getElements()[0]->hasError());
        self::assertSame('Missing value', $form->getFormElementGroup()->getElements()[0]->getError());

        self::assertFalse($form->getFormElementGroup()->getElements()[1]->getValue());
        self::assertTrue($form->getFormElementGroup()->getElements()[1]->hasError());
        self::assertSame('Missing value', $form->getFormElementGroup()->getElements()[1]->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup1()->getElements()[0]->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[0]->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getElements()[0]->getError());

        self::assertFalse($form->getPrivateFormElementGroup1()->getElements()[1]->getValue());
        self::assertTrue($form->getPrivateFormElementGroup1()->getElements()[1]->hasError());
        self::assertSame('Missing value', $form->getPrivateFormElementGroup1()->getElements()[1]->getError());

        self::assertFalse($form->getPrivateFormElementGroup2()->hasError());

        self::assertSame('', $form->getPrivateFormElementGroup2()->getElements()[0]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[0]->hasError());

        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->getValue());
        self::assertFalse($form->getPrivateFormElementGroup2()->getElements()[1]->hasError());

        self::assertSame('This is the default value', $form->getDefaultValueElement()->getValue());
        self::assertFalse($form->getDefaultValueElement()->hasError());
    }

    /**
     * Normalizes the end of line character(s) to \n, so tests will pass, even if the newline(s) in tests files are converted, e.g. by Git.
     *
     * @param string $s
     *
     * @return string
     */
    private static function normalizeEndOfLine(string $s): string
    {
        return str_replace("\r\n", "\n", $s);
    }
}
