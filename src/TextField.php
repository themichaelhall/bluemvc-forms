<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField extends AbstractTextInputField
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
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        parent::__construct($name, $value, TextFormatOption::TRIM);
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
        return $this->getText();
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
}
