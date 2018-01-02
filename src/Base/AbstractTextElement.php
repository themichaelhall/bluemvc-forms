<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\TextFormatOptions;

/**
 * Abstract class representing a text element.
 *
 * @since 1.0.0
 */
abstract class AbstractTextElement extends AbstractSetFormValueElement
{
    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty()
    {
        return $this->myText === '';
    }

    /**
     * Constructs the text element.
     *
     * @since 1.0.0
     *
     * @param string $name              The name.
     * @param string $value             The value to display in input field.
     * @param int    $textFormatOptions The text format options.
     *
     * @throws \InvalidArgumentException If any of the parameters are of invalid type.
     */
    protected function __construct($name, $value = '', $textFormatOptions = TextFormatOptions::NONE)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        if (!is_int($textFormatOptions)) {
            throw new \InvalidArgumentException('$textFormatOptions parameter is not an integer.');
        }

        parent::__construct($name);

        $this->myTextFormatOptions = $textFormatOptions;
        $value = $this->mySanitizeText($value);
        $this->onFormatText($value);
        $this->myText = $value;
    }

    /**
     * Returns the value to display in input field.
     *
     * @since 1.0.0
     *
     * @return string The value to display in input field.
     */
    protected function getText()
    {
        return $this->myText;
    }

    /**
     * Returns true if this text element is multi-line, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if this text element is multi-line, false otherwise.
     */
    abstract protected function isMultiLine();

    /**
     * Called when text should be formatted.
     *
     * @since 1.0.0
     *
     * @param string $text The text.
     */
    protected function onFormatText(&$text)
    {
        $lines = preg_split("/\r\n|\n|\r/", $text);
        $result = [];

        $lastEmptyLinesCount = 0;
        $hasFoundNonEmptyLines = false;

        foreach ($lines as $line) {
            if (($this->myTextFormatOptions & TextFormatOptions::TRIM) !== 0) {
                $line = trim($line);
            }
            if (($this->myTextFormatOptions & TextFormatOptions::COMPACT) !== 0) {
                $line = preg_replace('/\s+/', ' ', $line);
            }

            if ($line === '') {
                if (($this->myTextFormatOptions & TextFormatOptions::COMPACT_LINES) !== 0 && $lastEmptyLinesCount > 0) {
                    continue;
                }
                if (($this->myTextFormatOptions & TextFormatOptions::TRIM_LINES) !== 0 && !$hasFoundNonEmptyLines) {
                    continue;
                }

                $lastEmptyLinesCount++;
            } else {
                $lastEmptyLinesCount = 0;
                $hasFoundNonEmptyLines = true;
            }

            $result[] = $line;
        }

        if (($this->myTextFormatOptions & TextFormatOptions::TRIM_LINES) !== 0 && $lastEmptyLinesCount > 0) {
            // Trim the last empty lines (we did not know until now that those were at the end).
            array_splice($result, -$lastEmptyLinesCount);
        }

        $text = implode("\r\n", $result);
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
        $value = $this->mySanitizeText($value);
        $this->onFormatText($value);
        $this->myText = $value;

        parent::onSetFormValue($value);

        $this->onSetText($value);
    }

    /**
     * Called when text is set from form.
     *
     * @since 1.0.0
     *
     * @param string $text The text from form.
     */
    protected function onSetText($text)
    {
    }

    /**
     * Sanitizes the text.
     *
     * @param string $text The text.
     *
     * @return string The sanitized text.
     */
    private function mySanitizeText($text)
    {
        $text = preg_replace($this->isMultiLine() ? '/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/u' : '/[\x00-\x1F\x7F]/u', '', $text);

        return $text;
    }

    /**
     * @var int My text format options.
     */
    private $myTextFormatOptions;

    /**
     * @var string My text to display in input form.
     */
    private $myText;
}
