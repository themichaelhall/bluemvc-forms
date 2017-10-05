<?php

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\PostForm;
use BlueMvc\Forms\TextField;

/**
 * A very simple post form.
 */
class SimpleTestPostForm extends PostForm
{
    /**
     * @var TextField My text field.
     */
    public $Text;

    /**
     * Constructs the simple test post form.
     */
    public function __construct()
    {
        $this->Text = new TextField('text');
    }
}
