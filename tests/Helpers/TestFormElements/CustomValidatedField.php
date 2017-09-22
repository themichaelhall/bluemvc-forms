<?php

namespace BlueMvc\Forms\Tests\Helpers\TestFormElements;

use BlueMvc\Forms\TextField;

/**
 * A test class that extends TextField class and adds custom validation.
 */
class CustomValidatedField extends TextField
{
    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
        parent::onSetFormValue($value);

        if ($this->getValue() === 'invalid') {
            $this->setError('Value of custom validated field is invalid.');
        }
    }
}
