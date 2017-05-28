<?php

namespace BlueMvc\Forms\Tests\Helpers\TestFormElements;

use BlueMvc\Forms\TextField;

/**
 * A test class that extends TextField class and adds custom validation.
 */
class CustomValidatedField extends TextField
{
    /**
     * Called when form element should be validated.
     */
    public function onValidate()
    {
        parent::onValidate();

        if ($this->getValue() === 'invalid') {
            $this->setError('Value of custom validated field is invalid.');
        }
    }
}
