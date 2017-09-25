<?php

namespace BlueMvc\Forms\Tests\Helpers\TestFormElements;

use BlueMvc\Forms\TextField;

/**
 * A name field test class that extends TextField class and formats text.
 */
class NameField extends TextField
{
    /**
     * Formats the text.
     * Excessive whitespaces are removed and every first character in word is capitalized.
     *
     * @param string $text The text.
     *
     * @return string The formatted text.
     */
    protected function formatText($text)
    {
        $text = parent::formatText($text);
        $text = ucwords($text);

        return $text;
    }
}
