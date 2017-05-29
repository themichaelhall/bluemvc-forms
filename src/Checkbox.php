<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractInputField;

/**
 * Class representing a checkbox.
 *
 * @since 1.0.0
 */
class Checkbox extends AbstractInputField
{
    /**
     * Constructs the checkbox.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param bool   $value The value.
     *
     * @throws \InvalidArgumentException If any of the $name or $value parameters is not the correct type.
     */
    public function __construct($name, $value = false)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('$value parameter is not a boolean.');
        }

        parent::__construct($name, $value);

        $this->myValue = $value;
    }

    /**
     * Returns the value of the checkbox.
     *
     * @since 1.0.0
     *
     * @return bool The value of the checkbox.
     */
    public function getValue()
    {
        return $this->myValue;
    }

    /**
     * Returns the name of the display value parameter.
     *
     * @since 1.0.0
     *
     * @return string The name of the display value parameter.
     */
    protected function getDisplayValueName()
    {
        return 'checked';
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
        return 'checkbox';
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
        $this->myValue = strtolower($value) === 'on';
        $this->setDisplayValue($this->myValue);
    }

    /**
     * @var bool My value.
     */
    private $myValue;
}
