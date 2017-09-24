<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\Interfaces\SetFormValueInterface;
use BlueMvc\Forms\TextFormatOption;

/**
 * Abstract class representing a text element.
 *
 * @since 1.0.0
 */
abstract class AbstractTextElement extends AbstractFormElement implements SetFormValueInterface
{
    /**
     * Returns the text format options.
     *
     * @since 1.0.0
     *
     * @return int The text format options.
     */
    public function getTextFormatOptions()
    {
        return $this->myTextFormatOptions;
    }

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

        $this->myText = $this->formatText($value);
        $this->onSetFormValue($this->myText);
    }

    /**
     * Sets the text format options.
     *
     * @since 1.0.0
     *
     * @param int $textFormatOptions The text format options.
     *
     * @throws \InvalidArgumentException If the $textFormatOptions parameter is not an integer.
     */
    public function setTextFormatOptions($textFormatOptions)
    {
        if (!is_int($textFormatOptions)) {
            throw new \InvalidArgumentException('$textFormatOptions parameter is not an integer.');
        }

        $this->myTextFormatOptions = $textFormatOptions;
    }

    /**
     * Constructs the text element.
     *
     * @since 1.0.0
     *
     * @param string $name              The name.
     * @param string $text              The value to display in input field.
     * @param int    $textFormatOptions The text format options.
     */
    protected function __construct($name, $text, $textFormatOptions = TextFormatOption::NONE)
    {
        parent::__construct($name);

        $this->myTextFormatOptions = $textFormatOptions;
        $this->myText = $this->formatText($text);
    }

    /**
     * Formats the text.
     *
     * @since 1.0.0
     *
     * @param string $text The text.
     *
     * @return string The formatted text.
     */
    protected function formatText($text)
    {
        if ($this->myTextFormatOptions & TextFormatOption::TRIM !== 0) {
            $text = trim($text);
        }

        return $text;
    }

    /**
     * Returns the value to dipslay in input field.
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
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
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
