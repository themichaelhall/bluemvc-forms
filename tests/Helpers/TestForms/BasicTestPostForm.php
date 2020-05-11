<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\CheckBox;
use BlueMvc\Forms\DateField;
use BlueMvc\Forms\DateTimeField;
use BlueMvc\Forms\EmailField;
use BlueMvc\Forms\FileField;
use BlueMvc\Forms\FormElementGroup;
use BlueMvc\Forms\HiddenField;
use BlueMvc\Forms\IntegerField;
use BlueMvc\Forms\Interfaces\CheckBoxInterface;
use BlueMvc\Forms\Interfaces\DateFieldInterface;
use BlueMvc\Forms\Interfaces\DateTimeFieldInterface;
use BlueMvc\Forms\Interfaces\EmailFieldInterface;
use BlueMvc\Forms\Interfaces\FileFieldInterface;
use BlueMvc\Forms\Interfaces\FormElementGroupInterface;
use BlueMvc\Forms\Interfaces\HiddenFieldInterface;
use BlueMvc\Forms\Interfaces\IntegerFieldInterface;
use BlueMvc\Forms\Interfaces\PasswordFieldInterface;
use BlueMvc\Forms\Interfaces\RadioButtonCollectionInterface;
use BlueMvc\Forms\Interfaces\SelectInterface;
use BlueMvc\Forms\Interfaces\TextAreaInterface;
use BlueMvc\Forms\Interfaces\TextFieldInterface;
use BlueMvc\Forms\Interfaces\UrlFieldInterface;
use BlueMvc\Forms\Option;
use BlueMvc\Forms\PasswordField;
use BlueMvc\Forms\PostForm;
use BlueMvc\Forms\RadioButton;
use BlueMvc\Forms\RadioButtonCollection;
use BlueMvc\Forms\Select;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\CustomValidatedField;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\JsonFileField;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\NameField;
use BlueMvc\Forms\TextArea;
use BlueMvc\Forms\TextField;
use BlueMvc\Forms\UrlField;

/**
 * A basic test post form.
 */
class BasicTestPostForm extends PostForm
{
    /**
     * Constructs the basic test post form.
     *
     * @param bool $disableElements It true, disable all elements.
     */
    public function __construct(bool $disableElements = false)
    {
        $this->notRequiredField = new TextField('not-required');
        $this->notRequiredField->setRequired(false);
        $this->notRequiredField->setDisabled($disableElements);

        $this->customValidatedField = new CustomValidatedField('custom-validated');
        $this->customValidatedField->setDisabled($disableElements);

        $this->textField = new TextField('text');
        $this->textField->setDisabled($disableElements);

        $this->passwordField = new PasswordField('password');
        $this->passwordField->setDisabled($disableElements);

        $this->nameField = new NameField('name');
        $this->nameField->setDisabled($disableElements);

        $this->urlField = new UrlField('url');
        $this->urlField->setDisabled($disableElements);

        $this->checkBox = new CheckBox('checkbox');
        $this->checkBox->setDisabled($disableElements);

        $this->textArea = new TextArea('textarea');
        $this->textArea->setDisabled($disableElements);

        $this->select = new Select('select');
        $this->select->setDisabled($disableElements);
        $this->select->addOption(new Option('foo', 'Foo option'));
        $this->select->addOption(new Option('bar', 'Bar option'));

        $this->fileField = new FileField('file');
        $this->fileField->setDisabled($disableElements);

        $this->emailField = new EmailField('email');
        $this->emailField->setDisabled($disableElements);

        $this->hiddenField = new HiddenField('hidden');
        $this->hiddenField->setDisabled($disableElements);

        $this->integerField = new IntegerField('integer');
        $this->integerField->setDisabled($disableElements);

        $this->dateField = new DateField('date');
        $this->dateField->setDisabled($disableElements);

        $this->jsonFileField = new JsonFileField('json');
        $this->jsonFileField->setDisabled($disableElements);

        $this->radioButtons = new RadioButtonCollection('radio');
        $this->radioButtons->addRadioButton(new RadioButton('foo', 'Foo radio button'));
        $this->radioButtons->addRadioButton(new RadioButton('bar', 'Bar radio button'));
        $this->radioButtons->setDisabled($disableElements);

        $this->dateTimeField = new DateTimeField('datetime');
        $this->dateTimeField->setDisabled($disableElements);

        $this->privateField1 = new TextField('private-1');
        $this->privateField1->setDisabled($disableElements);
        $this->addElement($this->privateField1);

        $this->privateField2 = new TextField('private-2');
        $this->privateField2->setDisabled($disableElements);

        $this->formElementGroup = new FormElementGroup();
        $groupText = new TextField('group-text');
        $groupText->setDisabled($disableElements);
        $this->formElementGroup->addElement($groupText);
        $groupCheckBox = new CheckBox('group-checkbox');
        $groupCheckBox->setDisabled($disableElements);
        $this->formElementGroup->addElement($groupCheckBox);

        $this->privateFormElementGroup1 = new FormElementGroup();
        $privateGroup1Text = new TextField('private-group-text-1');
        $privateGroup1Text->setDisabled($disableElements);
        $this->privateFormElementGroup1->addElement($privateGroup1Text);
        $privateGroup1CheckBox = new CheckBox('private-group-checkbox-1');
        $privateGroup1CheckBox->setDisabled($disableElements);
        $this->privateFormElementGroup1->addElement($privateGroup1CheckBox);
        $this->addElementGroup($this->privateFormElementGroup1);

        $this->privateFormElementGroup2 = new FormElementGroup();
        $privateGroup2Text = new TextField('private-group-text-2');
        $privateGroup2Text->setDisabled($disableElements);
        $this->privateFormElementGroup2->addElement($privateGroup2Text);
        $privateGroup2CheckBox = new CheckBox('private-group-checkbox-2');
        $privateGroup2CheckBox->setDisabled($disableElements);
        $this->privateFormElementGroup2->addElement($privateGroup2CheckBox);

        $this->defaultValueElement = new TextField('default-value', 'This is the default value');
        $this->defaultValueElement->setDisabled($disableElements);

        $this->eventMethodsCalled = [];
    }

    /**
     * Returns the names of the event methods called.
     *
     * @return string[] The names of the event methods called.
     */
    public function getEventMethodsCalled(): array
    {
        return $this->eventMethodsCalled;
    }

    /**
     * Returns my form field that not requires a value.
     *
     * @return TextFieldInterface My form field that not requires a value.
     */
    public function getNotRequiredField(): TextFieldInterface
    {
        return $this->notRequiredField;
    }

    /**
     * Returns my field that has a custom validation.
     *
     * @return CustomValidatedField My field that has a custom validation.
     */
    public function getCustomValidatedField(): CustomValidatedField
    {
        return $this->customValidatedField;
    }

    /**
     * Returns my text field.
     *
     * @return TextFieldInterface My text field.
     */
    public function getTextField(): TextFieldInterface
    {
        return $this->textField;
    }

    /**
     * Returns my password field.
     *
     * @return PasswordFieldInterface My password field.
     */
    public function getPasswordField(): PasswordFieldInterface
    {
        return $this->passwordField;
    }

    /**
     * Returns my name field.
     *
     * @return NameField My name field.
     */
    public function getNameField(): NameField
    {
        return $this->nameField;
    }

    /**
     * Returns my url field.
     *
     * @return UrlFieldInterface My url field.
     */
    public function getUrlField(): UrlFieldInterface
    {
        return $this->urlField;
    }

    /**
     * Returns my checkbox.
     *
     * @return CheckBoxInterface My checkbox.
     */
    public function getCheckBox(): CheckBoxInterface
    {
        return $this->checkBox;
    }

    /**
     * Returns my text area.
     *
     * @return TextAreaInterface My text area.
     */
    public function getTextArea(): TextAreaInterface
    {
        return $this->textArea;
    }

    /**
     * Returns my select.
     *
     * @return SelectInterface My select.
     */
    public function getSelect(): SelectInterface
    {
        return $this->select;
    }

    /**
     * Returns my file field.
     *
     * @return FileFieldInterface My file field.
     */
    public function getFileField(): FileFieldInterface
    {
        return $this->fileField;
    }

    /**
     * Returns my email field.
     *
     * @return EmailFieldInterface My email field.
     */
    public function getEmailField(): EmailFieldInterface
    {
        return $this->emailField;
    }

    /**
     * Returns my hidden field.
     *
     * @return HiddenFieldInterface My hidden field.
     */
    public function getHiddenField(): HiddenFieldInterface
    {
        return $this->hiddenField;
    }

    /**
     * Returns my integer field.
     *
     * @return IntegerFieldInterface My integer field.
     */
    public function getIntegerField(): IntegerFieldInterface
    {
        return $this->integerField;
    }

    /**
     * Returns my date field.
     *
     * @return DateFieldInterface My date field.
     */
    public function getDateField(): DateFieldInterface
    {
        return $this->dateField;
    }

    /**
     * Returns my json file field.
     *
     * @return JsonFileField My json file field.
     */
    public function getJsonFileField(): JsonFileField
    {
        return $this->jsonFileField;
    }

    /**
     * Returns my radio buttons.
     *
     * @return RadioButtonCollectionInterface My radio buttons.
     */
    public function getRadioButtons(): RadioButtonCollectionInterface
    {
        return $this->radioButtons;
    }

    /**
     * Returns my date time field.
     *
     * @return DateTimeFieldInterface My date time field.
     */
    public function getDateTimeField(): DateTimeFieldInterface
    {
        return $this->dateTimeField;
    }

    /**
     * Returns my private field 1.
     *
     * @return TextFieldInterface My private field 1.
     */
    public function getPrivateField1(): TextFieldInterface
    {
        return $this->privateField1;
    }

    /**
     * Returns my private field 2.
     *
     * @return TextFieldInterface My private field 2.
     */
    public function getPrivateField2(): TextFieldInterface
    {
        return $this->privateField2;
    }

    /**
     * Returns my form element group.
     *
     * @return FormElementGroupInterface
     */
    public function getFormElementGroup(): FormElementGroupInterface
    {
        return $this->formElementGroup;
    }

    /**
     * Returns my private form element group 1.
     *
     * @return FormElementGroupInterface
     */
    public function getPrivateFormElementGroup1(): FormElementGroupInterface
    {
        return $this->privateFormElementGroup1;
    }

    /**
     * Returns my private form element group 2.
     *
     * @return FormElementGroupInterface
     */
    public function getPrivateFormElementGroup2(): FormElementGroupInterface
    {
        return $this->privateFormElementGroup2;
    }

    /**
     * Returns my element with a default value.
     *
     * @return TextFieldInterface
     */
    public function getDefaultValueElement(): TextFieldInterface
    {
        return $this->defaultValueElement;
    }

    /**
     * Called when form elements should be validated.
     */
    protected function onValidate(): void
    {
        parent::onValidate();

        $this->eventMethodsCalled[] = 'onValidate';

        if ($this->notRequiredField->getValue() === 'invalid') {
            $this->notRequiredField->setError('Value of not required field is invalid.');
        }

        if ($this->textField->isEmpty()) {
            $this->textField->setError('Value of text field is empty.');
        } elseif ($this->textField->getValue() === 'invalid') {
            $this->textField->setError('Value of text field is invalid.');
        }

        if ($this->passwordField->getValue() === 'invalid') {
            $this->passwordField->setError('Value of password field is invalid.');
        }

        if ($this->nameField->getValue() === 'Invalid') {
            $this->nameField->setError('Value of name field is invalid.');
        }

        if ($this->textArea->getValue() === 'invalid') {
            $this->textArea->setError('Value of text area is invalid.');
        }

        if ($this->fileField->getFile() !== null && strpos(file_get_contents($this->fileField->getFile()->getPath()->__toString()), 'invalid') !== false) {
            $this->fileField->setError('File content is invalid.');
        }

        if ($this->hiddenField->getValue() === 'invalid') {
            $this->hiddenField->setError('Value of hidden field is invalid.');
        }

        if ($this->privateField1->getValue() === 'invalid') {
            $this->privateField1->setError('Value of private field 1 is invalid.');
        }

        if ($this->privateField2->getValue() === 'invalid') {
            $this->privateField2->setError('Value of private field 2 is invalid.');
        }

        if ($this->formElementGroup->getElements()[0]->getValue() === 'invalid') {
            $this->formElementGroup->getElements()[0]->setError('Value of group text is invalid');
        } elseif ($this->formElementGroup->getElements()[0]->getValue() === 'invalid-group') {
            $this->formElementGroup->setError('Group is invalid');
        }

        if ($this->privateFormElementGroup1->getElements()[0]->getValue() === 'invalid') {
            $this->privateFormElementGroup1->getElements()[0]->setError('Value of private group 1 text is invalid');
        } elseif ($this->privateFormElementGroup1->getElements()[0]->getValue() === 'invalid-group') {
            $this->privateFormElementGroup1->setError('Private group 1 is invalid');
        }

        if ($this->privateFormElementGroup2->getElements()[0]->getValue() === 'invalid') {
            $this->privateFormElementGroup2->getElements()[0]->setError('Value of private group 2 text is invalid');
        } elseif ($this->privateFormElementGroup2->getElements()[0]->getValue() === 'invalid-group') {
            $this->privateFormElementGroup2->setError('Private group 2 is invalid');
        }

        if ($this->defaultValueElement->getValue() === 'invalid') {
            $this->defaultValueElement->setError('Value is invalid.');
        }
    }

    /**
     * Called if form processing was successful.
     */
    protected function onSuccess(): void
    {
        parent::onSuccess();

        $this->eventMethodsCalled[] = 'onSuccess';
    }

    /**
     * Called if form processing was not successful.
     */
    protected function onError(): void
    {
        parent::onError();

        $this->eventMethodsCalled[] = 'onError';
    }

    /**
     * Called when form processing finishes, regardless if processing was successful or not.
     */
    protected function onProcessed(): void
    {
        parent::onProcessed();

        $this->eventMethodsCalled[] = 'onProcessed';
    }

    /**
     * @var TextFieldInterface My form field that not requires a value.
     */
    protected $notRequiredField;

    /**
     * @var CustomValidatedField My field that has a custom validation.
     */
    protected $customValidatedField;

    /**
     * @var TextFieldInterface My text field.
     */
    protected $textField;

    /**
     * @var PasswordFieldInterface My password field.
     */
    protected $passwordField;

    /**
     * @var NameField My name field.
     */
    protected $nameField;

    /**
     * @var UrlFieldInterface My url field.
     */
    protected $urlField;

    /**
     * @var CheckBoxInterface My checkbox.
     */
    protected $checkBox;

    /**
     * @var TextAreaInterface My text area.
     */
    protected $textArea;

    /**
     * @var SelectInterface My select.
     */
    protected $select;

    /**
     * @var FileFieldInterface My file field.
     */
    protected $fileField;

    /**
     * @var EmailFieldInterface My email field.
     */
    protected $emailField;

    /**
     * @var HiddenFieldInterface My hidden field.
     */
    protected $hiddenField;

    /**
     * @var IntegerFieldInterface My integer field.
     */
    protected $integerField;

    /**
     * @var DateFieldInterface My date field.
     */
    protected $dateField;

    /**
     * @var JsonFileField My json file field.
     */
    protected $jsonFileField;

    /**
     * @var RadioButtonCollectionInterface My radio buttons.
     */
    protected $radioButtons;

    /**
     * @var DateTimeFieldInterface My date time field.
     */
    protected $dateTimeField;

    /**
     * @var FormElementGroupInterface My form element group.
     */
    protected $formElementGroup;

    /**
     * @var TextFieldInterface My private field 1.
     */
    private $privateField1;

    /**
     * @var TextFieldInterface My private field 2.
     */
    private $privateField2;

    /**
     * @var string[] The names of the event methods called.
     */
    private $eventMethodsCalled;

    /**
     * @var FormElementGroupInterface My private form element group 1.
     */
    private $privateFormElementGroup1;

    /**
     * @var FormElementGroupInterface My private form element group 2.
     */
    private $privateFormElementGroup2;

    /**
     * @var TextFieldInterface My element with a default value.
     */
    protected $defaultValueElement;
}
