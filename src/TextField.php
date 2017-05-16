<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractInputField;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField extends AbstractInputField
{
    /**
     * Constructs the text field.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param string $value The value.
     *
     * @throws \InvalidArgumentException If any of the $name or $value parameters is not a string.
     */
    public function __construct($name, $value = '')
    {
        parent::__construct($name, $value);

        $this->myValue = $value;
    }

    /**
     * Returns the value of the text field.
     *
     * @since 1.0.0
     *
     * @return string The value of the text field.
     */
    public function getValue()
    {
        return $this->myValue;
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
        return $text;
    }

    /**
     * Returns the input type.
     *
     * @since 1.0.0
     *
     * @return string The input type.
     */
    protected function getType()
    {
        return 'text';
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
        $this->myValue = $this->formatText(trim($value));
        $this->setDisplayValue($this->myValue);
    }

    /**
     * @var string My value.
     */
    private $myValue;
}
