<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\CheckBox;
use BlueMvc\Forms\DateField;
use BlueMvc\Forms\DateTimeField;
use BlueMvc\Forms\EmailField;
use BlueMvc\Forms\GetForm;
use BlueMvc\Forms\HiddenField;
use BlueMvc\Forms\IntegerField;
use BlueMvc\Forms\Interfaces\CheckBoxInterface;
use BlueMvc\Forms\Interfaces\DateFieldInterface;
use BlueMvc\Forms\Interfaces\DateTimeFieldInterface;
use BlueMvc\Forms\Interfaces\EmailFieldInterface;
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
use BlueMvc\Forms\RadioButton;
use BlueMvc\Forms\RadioButtonCollection;
use BlueMvc\Forms\Select;
use BlueMvc\Forms\Tests\Helpers\TestFormElementGroups\BasicFormElementGroup;
use BlueMvc\Forms\Tests\Helpers\TestFormElementGroups\OuterFormElementGroup;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\CustomValidatedField;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\NameField;
use BlueMvc\Forms\TextArea;
use BlueMvc\Forms\TextField;
use BlueMvc\Forms\UrlField;

/**
 * A basic test get form.
 */
class BasicTestGetForm extends GetForm
{
    /**
     * Constructs the basic test get form.
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

        $this->emailField = new EmailField('email');
        $this->emailField->setDisabled($disableElements);

        $this->hiddenField = new HiddenField('hidden');
        $this->hiddenField->setDisabled($disableElements);

        $this->integerField = new IntegerField('integer');
        $this->integerField->setDisabled($disableElements);

        $this->dateField = new DateField('date');
        $this->dateField->setDisabled($disableElements);

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

        $this->outerFormElementGroup = new OuterFormElementGroup('group-1', 'group-2', $disableElements);

        $this->privateFormElementGroup1 = new BasicFormElementGroup('group-3', $disableElements);
        $this->addElementGroup($this->privateFormElementGroup1);

        $this->privateFormElementGroup2 = new BasicFormElementGroup('group-4', $disableElements);

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
     * @return OuterFormElementGroup
     */
    public function getOuterFormElementGroup(): OuterFormElementGroup
    {
        return $this->outerFormElementGroup;
    }

    /**
     * Returns my private form element group 1.
     *
     * @return BasicFormElementGroup
     */
    public function getPrivateFormElementGroup1(): BasicFormElementGroup
    {
        return $this->privateFormElementGroup1;
    }

    /**
     * Returns my private form element group 2.
     *
     * @return BasicFormElementGroup
     */
    public function getPrivateFormElementGroup2(): BasicFormElementGroup
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

        if ($this->hiddenField->getValue() === 'invalid') {
            $this->hiddenField->setError('Value of hidden field is invalid.');
        }

        if ($this->privateField1->getValue() === 'invalid') {
            $this->privateField1->setError('Value of private field 1 is invalid.');
        }

        if ($this->privateField2->getValue() === 'invalid') {
            $this->privateField2->setError('Value of private field 2 is invalid.');
        }

        if ($this->outerFormElementGroup->getTextField1()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getTextField1()->setError('Value of outer group text field 1 is invalid.');
        } elseif ($this->outerFormElementGroup->getTextField1()->getValue() === 'invalid-group') {
            $this->outerFormElementGroup->setError('Outer group is invalid.');
        }

        if ($this->outerFormElementGroup->getTextField2()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getTextField2()->setError('Value of outer group text field 2 is invalid.');
        }

        if ($this->outerFormElementGroup->getFormElementGroup1()->getTextField()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getFormElementGroup1()->getTextField()->setError('Value of inner group 1 text field is invalid.');
        } elseif ($this->outerFormElementGroup->getFormElementGroup1()->getTextField()->getValue() === 'invalid-group') {
            $this->outerFormElementGroup->getFormElementGroup1()->setError('Inner group 1 is invalid.');
        }

        if ($this->outerFormElementGroup->getFormElementGroup1()->getPrivateTextField()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getFormElementGroup1()->getPrivateTextField()->setError('Value of inner group 1 private text field is invalid.');
        }

        if ($this->outerFormElementGroup->getFormElementGroup2()->getTextField()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getFormElementGroup2()->getTextField()->setError('Value of inner group 2 text field is invalid.');
        } elseif ($this->outerFormElementGroup->getFormElementGroup2()->getTextField()->getValue() === 'invalid-group') {
            $this->outerFormElementGroup->getFormElementGroup2()->setError('Inner group 2 is invalid.');
        }

        if ($this->outerFormElementGroup->getFormElementGroup2()->getPrivateTextField()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getFormElementGroup2()->getPrivateTextField()->setError('Value of inner group 2 private text field is invalid.');
        }

        if ($this->outerFormElementGroup->getPrivateFormElementGroup()->getTextField()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getPrivateFormElementGroup()->getTextField()->setError('Value of inner private group text field is invalid.');
        } elseif ($this->outerFormElementGroup->getPrivateFormElementGroup()->getTextField()->getValue() === 'invalid-group') {
            $this->outerFormElementGroup->getPrivateFormElementGroup()->setError('Inner private group is invalid.');
        }

        if ($this->outerFormElementGroup->getPrivateFormElementGroup()->getPrivateTextField()->getValue() === 'invalid') {
            $this->outerFormElementGroup->getPrivateFormElementGroup()->getPrivateTextField()->setError('Value of inner private group private text field is invalid.');
        }

        if ($this->privateFormElementGroup1->getTextField()->getValue() === 'invalid') {
            $this->privateFormElementGroup1->getTextField()->setError('Value of private group 1 text field is invalid.');
        } elseif ($this->privateFormElementGroup1->getTextField()->getValue() === 'invalid-group') {
            $this->privateFormElementGroup1->setError('Private group 1 is invalid.');
        }

        if ($this->privateFormElementGroup1->getPrivateTextField()->getValue() === 'invalid') {
            $this->privateFormElementGroup1->getPrivateTextField()->setError('Value of private group 1 text field is invalid.');
        }

        if ($this->privateFormElementGroup2->getTextField()->getValue() === 'invalid') {
            $this->privateFormElementGroup2->getTextField()->setError('Value of private group 2 text field is invalid.');
        } elseif ($this->privateFormElementGroup2->getTextField()->getValue() === 'invalid-group') {
            $this->privateFormElementGroup2->setError('Private group 2 is invalid.');
        }

        if ($this->privateFormElementGroup2->getPrivateTextField()->getValue() === 'invalid') {
            $this->privateFormElementGroup2->getPrivateTextField()->setError('Value of private group 2 text field is invalid.');
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
     * @var RadioButtonCollectionInterface My radio buttons.
     */
    protected $radioButtons;

    /**
     * @var DateTimeFieldInterface My date time field.
     */
    protected $dateTimeField;

    /**
     * @var OuterFormElementGroup My outer form element group.
     */
    protected $outerFormElementGroup;

    /**
     * @var TextFieldInterface My element with a default value.
     */
    protected $defaultValueElement;

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
     * @var BasicFormElementGroup My private form element group 1.
     */
    private $privateFormElementGroup1;

    /**
     * @var BasicFormElementGroup My private form element group 2.
     */
    private $privateFormElementGroup2;
}
