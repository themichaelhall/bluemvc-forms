<?php

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\CheckBox;
use BlueMvc\Forms\DateField;
use BlueMvc\Forms\DateTimeField;
use BlueMvc\Forms\EmailField;
use BlueMvc\Forms\FileField;
use BlueMvc\Forms\HiddenField;
use BlueMvc\Forms\IntegerField;
use BlueMvc\Forms\Interfaces\CheckBoxInterface;
use BlueMvc\Forms\Interfaces\DateFieldInterface;
use BlueMvc\Forms\Interfaces\DateTimeFieldInterface;
use BlueMvc\Forms\Interfaces\EmailFieldInterface;
use BlueMvc\Forms\Interfaces\FileFieldInterface;
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
     */
    public function __construct()
    {
        $this->myNotRequiredField = new TextField('not-required');
        $this->myNotRequiredField->setRequired(false);
        $this->myCustomValidatedField = new CustomValidatedField('custom-validated');

        $this->myTextField = new TextField('text');
        $this->myPasswordField = new PasswordField('password');
        $this->myNameField = new NameField('name');
        $this->myUrlField = new UrlField('url');
        $this->myCheckBox = new CheckBox('checkbox');
        $this->myTextArea = new TextArea('textarea');
        $this->mySelect = new Select('select');
        $this->mySelect->addOption(new Option('foo', 'Foo option'));
        $this->mySelect->addOption(new Option('bar', 'Bar option'));
        $this->myFileField = new FileField('file');
        $this->myEmailField = new EmailField('email');
        $this->myHiddenField = new HiddenField('hidden');
        $this->myIntegerField = new IntegerField('integer');
        $this->myDateField = new DateField('date');
        $this->myJsonFileField = new JsonFileField('json');
        $this->myRadioButtons = new RadioButtonCollection('radio');
        $this->myRadioButtons->addRadioButton(new RadioButton('foo', 'Foo radio button'));
        $this->myRadioButtons->addRadioButton(new RadioButton('bar', 'Bar radio button'));
        $this->myDateTimeField = new DateTimeField('datetime');

        $this->myPrivateField1 = new TextField('private-1');
        $this->addElement($this->myPrivateField1);
        $this->myPrivateField2 = new TextField('private-2');

        $this->myEventMethodsCalled = [];
    }

    /**
     * Returns the names of the event methods called.
     *
     * @return string[] The names of the event methods called.
     */
    public function getEventMethodsCalled()
    {
        return $this->myEventMethodsCalled;
    }

    /**
     * Returns my form field that not requires a value.
     *
     * @return TextFieldInterface My form field that not requires a value.
     */
    public function getNotRequiredField()
    {
        return $this->myNotRequiredField;
    }

    /**
     * Returns my field that has a custom validation.
     *
     * @return CustomValidatedField My field that has a custom validation.
     */
    public function getCustomValidatedField()
    {
        return $this->myCustomValidatedField;
    }

    /**
     * Returns my text field.
     *
     * @return TextFieldInterface My text field.
     */
    public function getTextField()
    {
        return $this->myTextField;
    }

    /**
     * Returns my password field.
     *
     * @return PasswordFieldInterface My password field.
     */
    public function getPasswordField()
    {
        return $this->myPasswordField;
    }

    /**
     * Returns my name field.
     *
     * @return NameField My name field.
     */
    public function getNameField()
    {
        return $this->myNameField;
    }

    /**
     * Returns my url field.
     *
     * @return UrlFieldInterface My url field.
     */
    public function getUrlField()
    {
        return $this->myUrlField;
    }

    /**
     * Returns my checkbox.
     *
     * @return CheckBoxInterface My checkbox.
     */
    public function getCheckBox()
    {
        return $this->myCheckBox;
    }

    /**
     * Returns my text area.
     *
     * @return TextAreaInterface My text area.
     */
    public function getTextArea()
    {
        return $this->myTextArea;
    }

    /**
     * Returns my select.
     *
     * @return SelectInterface My select.
     */
    public function getSelect()
    {
        return $this->mySelect;
    }

    /**
     * Returns my file field.
     *
     * @return FileFieldInterface My file field.
     */
    public function getFileField()
    {
        return $this->myFileField;
    }

    /**
     * Returns my email field.
     *
     * @return EmailFieldInterface My email field.
     */
    public function getEmailField()
    {
        return $this->myEmailField;
    }

    /**
     * Returns my hidden field.
     *
     * @return HiddenFieldInterface My hidden field.
     */
    public function getHiddenField()
    {
        return $this->myHiddenField;
    }

    /**
     * Returns my integer field.
     *
     * @return IntegerFieldInterface My integer field.
     */
    public function getIntegerField()
    {
        return $this->myIntegerField;
    }

    /**
     * Returns my date field.
     *
     * @return DateFieldInterface My date field.
     */
    public function getDateField()
    {
        return $this->myDateField;
    }

    /**
     * Returns my json file field.
     *
     * @return JsonFileField My json file field.
     */
    public function getJsonFileField()
    {
        return $this->myJsonFileField;
    }

    /**
     * Returns my radio buttons.
     *
     * @return RadioButtonCollectionInterface My radio buttons.
     */
    public function getRadioButtons()
    {
        return $this->myRadioButtons;
    }

    /**
     * Returns my date time field.
     *
     * @return DateTimeFieldInterface My date time field.
     */
    public function getDateTimeField()
    {
        return $this->myDateTimeField;
    }

    /**
     * Returns my private field 1.
     *
     * @return TextFieldInterface My private field 1.
     */
    public function getPrivateField1()
    {
        return $this->myPrivateField1;
    }

    /**
     * Returns my private field 2.
     *
     * @return TextFieldInterface My private field 2.
     */
    public function getPrivateField2()
    {
        return $this->myPrivateField2;
    }

    /**
     * Called when form elements should be validated.
     */
    protected function onValidate()
    {
        parent::onValidate();

        $this->myEventMethodsCalled[] = 'onValidate';

        if ($this->myNotRequiredField->getValue() === 'invalid') {
            $this->myNotRequiredField->setError('Value of not required field is invalid.');
        }

        if ($this->myTextField->getValue() === 'invalid') {
            $this->myTextField->setError('Value of text field is invalid.');
        }

        if ($this->myPasswordField->getValue() === 'invalid') {
            $this->myPasswordField->setError('Value of password field is invalid.');
        }

        if ($this->myNameField->getValue() === 'Invalid') {
            $this->myNameField->setError('Value of name field is invalid.');
        }

        if ($this->myTextArea->getValue() === 'invalid') {
            $this->myTextArea->setError('Value of text area is invalid.');
        }

        if ($this->myFileField->getFile() !== null && strpos(file_get_contents($this->myFileField->getFile()->getPath()->__toString()), 'invalid') !== false) {
            $this->myFileField->setError('File content is invalid.');
        }

        if ($this->myHiddenField->getValue() === 'invalid') {
            $this->myHiddenField->setError('Value of hidden field is invalid.');
        }

        if ($this->myPrivateField1->getValue() === 'invalid') {
            $this->myPrivateField1->setError('Value of private field 1 is invalid.');
        }

        if ($this->myPrivateField2->getValue() === 'invalid') {
            $this->myPrivateField2->setError('Value of private field 2 is invalid.');
        }
    }

    /**
     * Called if form processing was successful.
     */
    protected function onSuccess()
    {
        parent::onSuccess();

        $this->myEventMethodsCalled[] = 'onSuccess';
    }

    /**
     * Called if form processing was not successful.
     */
    protected function onError()
    {
        parent::onError();

        $this->myEventMethodsCalled[] = 'onError';
    }

    /**
     * Called when form processing finishes, regardless if processing was successful or not.
     */
    protected function onProcessed()
    {
        parent::onProcessed();

        $this->myEventMethodsCalled[] = 'onProcessed';
    }

    /**
     * @var TextFieldInterface My form field that not requires a value.
     */
    protected $myNotRequiredField;

    /**
     * @var CustomValidatedField My field that has a custom validation.
     */
    protected $myCustomValidatedField;

    /**
     * @var TextFieldInterface My text field.
     */
    protected $myTextField;

    /**
     * @var PasswordFieldInterface My password field.
     */
    protected $myPasswordField;

    /**
     * @var NameField My name field.
     */
    protected $myNameField;

    /**
     * @var UrlFieldInterface My url field.
     */
    protected $myUrlField;

    /**
     * @var CheckBoxInterface My checkbox.
     */
    protected $myCheckBox;

    /**
     * @var TextAreaInterface My text area.
     */
    protected $myTextArea;

    /**
     * @var SelectInterface My select.
     */
    protected $mySelect;

    /**
     * @var FileFieldInterface My file field.
     */
    protected $myFileField;

    /**
     * @var EmailFieldInterface My email field.
     */
    protected $myEmailField;

    /**
     * @var HiddenFieldInterface My hidden field.
     */
    protected $myHiddenField;

    /**
     * @var IntegerFieldInterface My integer field.
     */
    protected $myIntegerField;

    /**
     * @var DateFieldInterface My date field.
     */
    protected $myDateField;

    /**
     * @var JsonFileField My json file field.
     */
    protected $myJsonFileField;

    /**
     * @var RadioButtonCollectionInterface My radio buttons.
     */
    protected $myRadioButtons;

    /**
     * @var DateTimeFieldInterface My date time field.
     */
    protected $myDateTimeField;

    /**
     * @var TextFieldInterface My private field 1.
     */
    private $myPrivateField1;

    /**
     * @var TextFieldInterface My private field 2.
     */
    private $myPrivateField2;

    /**
     * @var string[] The names of the event methods called.
     */
    private $myEventMethodsCalled;
}
