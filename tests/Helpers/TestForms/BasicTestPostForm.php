<?php

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\CheckBox;
use BlueMvc\Forms\PasswordField;
use BlueMvc\Forms\PostForm;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\CustomValidatedField;
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
     * @return TextField My form field that not requires a value.
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
     * @return TextField My text field.
     */
    public function getTextField()
    {
        return $this->myTextField;
    }

    /**
     * Returns my password field.
     *
     * @return PasswordField My password field.
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
     * @return UrlField My url field.
     */
    public function getUrlField()
    {
        return $this->myUrlField;
    }

    /**
     * Returns my checkbox.
     *
     * @return CheckBox My checkbox.
     */
    public function getCheckBox()
    {
        return $this->myCheckBox;
    }

    /**
     * Returns my text area.
     *
     * @return TextArea My text area.
     */
    public function getTextArea()
    {
        return $this->myTextArea;
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
     * @var TextField My form field that not requires a value.
     */
    protected $myNotRequiredField;

    /**
     * @var CustomValidatedField My field that has a custom validation.
     */
    protected $myCustomValidatedField;

    /**
     * @var TextField My text field.
     */
    protected $myTextField;

    /**
     * @var PasswordField My password field.
     */
    protected $myPasswordField;

    /**
     * @var NameField My name field.
     */
    protected $myNameField;

    /**
     * @var UrlField My url field.
     */
    protected $myUrlField;

    /**
     * @var CheckBox My checkbox.
     */
    protected $myCheckBox;

    /**
     * @var TextArea My text area.
     */
    protected $myTextArea;

    /**
     * @var string[] The names of the event methods called.
     */
    private $myEventMethodsCalled;
}
