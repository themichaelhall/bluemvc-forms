<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\Interfaces\SetFormValueInterface;
use BlueMvc\Forms\TextFormatOptions;

/**
 * Abstract class representing a text element.
 *
 * @since 1.0.0
 */
abstract class AbstractTextElement extends AbstractFormElement implements SetFormValueInterface
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
     * Sets the value from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     *
     * @throws \InvalidArgumentException If the $value parameter is not a string.
     */
    public function setFormValue($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        $this->onSetFormValue($value);
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
        $this->onFormatText($value);
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
        $this->myText = $text;

        // fixme: move this check to base class.
        if ($this->isEmpty() && $this->isRequired()) {
            $this->setError('Missing value');

            return;
        }
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
