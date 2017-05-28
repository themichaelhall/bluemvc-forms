<?php

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\PasswordField;
use BlueMvc\Forms\PostForm;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\CustomValidatedField;
use BlueMvc\Forms\Tests\Helpers\TestFormElements\NameField;
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
     * Called when form elements should be validated.
     */
    protected function onValidate()
    {
        parent::onValidate();

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
}
