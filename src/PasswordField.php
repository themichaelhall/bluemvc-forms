<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;

/**
 * Class representing a password field.
 *
 * @since 1.0.0
 */
class PasswordField extends AbstractTextInputField
{
    /**
     * Constructs the password field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameters is not a string.
     */
    public function __construct($name)
    {
        parent::__construct($name);
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = [])
    {
        // Hide value from displaying.
        $attributes['value'] = null;

        return parent::getHtml($attributes);
    }

    /**
     * Returns the value of the password field.
     *
     * @since 1.0.0
     *
     * @return string The value of the password field.
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
        return 'password';
    }
}
