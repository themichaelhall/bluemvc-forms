<?php

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
    }

    /**
     * Returns my text field.
     *
     * @return TextField My test field.
     */
    public function getTextField()
    {
        return $this->myTextField;
    }

    /**
     * @var TextField My text field.
     */
    protected $myTextField;
}
