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
     *
     * Every first character in word is capitalized.
     *
     * @param string $text The text.
     */
    protected function onFormatText(&$text)
    {
        parent::onFormatText($text);

        $text = ucwords($text);
    }
}
