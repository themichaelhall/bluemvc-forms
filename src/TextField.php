<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField
{
    /**
     * Constructs the text field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function __construct($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name parameter is not a string.');
        }

        $this->myName = $name;
        $this->myValue = '';
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @return string The element html.
     */
    public function getHtml()
    {
        return '<input type="text" name="' . htmlspecialchars($this->myName) . '"' . ($this->myValue !== '' ? ' value="' . htmlspecialchars($this->myValue) . '"' : '') . '>';
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
     * Sets the value from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    public function setFormValue($value)
    {
        $this->myValue = $value;
    }

    /**
     * @var string My name.
     */
    private $myName;

    /**
     * @var string My value.
     */
    private $myValue;
}
