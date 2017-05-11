<?php

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\PostForm;
use BlueMvc\Forms\TextField;

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
        $this->myTextField = new TextField('text');

        $this->myNotRequiredField = new TextField('not-required');
        $this->myNotRequiredField->setRequired(false);
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
     * Returns my form field that not requires a value.
     *
     * @return TextField My form field that not requires a value.
     */
    public function getNotRequiredField()
    {
        return $this->myNotRequiredField;
    }

    /**
     * Called when form elements should be validated.
     */
    protected function onValidate()
    {
        parent::onValidate();

        if ($this->myTextField->getValue() === 'invalid') {
            $this->myTextField->setError('Value of text field is invalid.');
        }

        if ($this->myNotRequiredField->getValue() === 'invalid') {
            $this->myNotRequiredField->setError('Value of not required field is invalid.');
        }
    }

    /**
     * @var TextField My text field.
     */
    protected $myTextField;

    /**
     * @var TextField My form field that not requires a value.
     */
    protected $myNotRequiredField;
}
