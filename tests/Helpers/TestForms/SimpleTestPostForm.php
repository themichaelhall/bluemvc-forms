<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests\Helpers\TestForms;

use BlueMvc\Forms\Interfaces\TextFieldInterface;
use BlueMvc\Forms\PostForm;
use BlueMvc\Forms\TextField;

/**
 * A very simple post form.
 */
class SimpleTestPostForm extends PostForm
{
    /**
     * @var TextFieldInterface The text field.
     */
    public TextFieldInterface $Text;

    /**
     * Constructs the simple test post form.
     */
    public function __construct()
    {
        $this->Text = new TextField('text');
    }
}
