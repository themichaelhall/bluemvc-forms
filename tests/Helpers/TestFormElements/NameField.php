<?php

declare(strict_types=1);

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
    protected function onFormatText(string &$text): void
    {
        $text = ucwords($text);
    }
}
