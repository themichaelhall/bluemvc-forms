<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests\Helpers\TestFormElements;

use BlueMvc\Forms\TextField;

/**
 * A test class that extends TextField class and adds custom validation.
 */
class CustomValidatedField extends TextField
{
    /**
     * Called when text is set from form.
     *
     * @since 1.0.0
     *
     * @param string $text The text from form.
     */
    protected function onSetText(string $text): void
    {
        if ($this->hasError()) {
            return;
        }

        if ($text === 'invalid') {
            $this->setError('Value of custom validated field is invalid.');
        }
    }
}
