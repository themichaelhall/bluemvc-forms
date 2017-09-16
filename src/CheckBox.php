<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractFormElement;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a checkbox.
 *
 * @since 1.0.0
 */
class CheckBox extends AbstractFormElement
{
    use BuildTagTrait;

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

        parent::__construct($name);

        $this->myValue = $value;
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
        return self::myBuildTag('input', null,
            array_merge(
                [
                    'type'     => 'checkbox',
                    'name'     => $this->getName(),
                    'checked'  => $this->myValue,
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
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
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty()
    {
        return !$this->myValue;
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

        $this->myValue = strtolower($value) === 'on';
    }

    /**
     * @var bool My value.
     */
    private $myValue;
}
