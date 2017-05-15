<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractInputField;

/**
 * Class representing a password field.
 *
 * @since 1.0.0
 */
class PasswordField extends AbstractInputField
{
    /**
     * Constructs the password field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $value parameters is not a string.
     */
    public function __construct($name)
    {
        parent::__construct($name, '');

        $this->myValue = '';
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
        return $this->myValue;
    }

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty()
    {
        return $this->myValue === '';
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

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
        $this->myValue = $value;
        $this->setDisplayValue('');
    }

    /**
     * @var string My value.
     */
    private $myValue;
}
