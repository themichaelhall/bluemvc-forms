<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

/**
 * Abstract class representing an input type="..." field.
 *
 * @since 1.0.0
 */
abstract class AbstractInputField extends AbstractFormElement
{
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
        return self::buildTag('input', null,
            array_merge(
                [
                    'type'     => $this->getType(),
                    'name'     => $this->getName(),
                    'value'    => $this->myDisplayValue,
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
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
        return $this->myDisplayValue === null || $this->myDisplayValue === '';
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
     * Constructs the input field.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param mixed  $value The value to display in input field.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    protected function __construct($name, $value)
    {
        parent::__construct($name);

        $this->myDisplayValue = $value;
    }

    /**
     * Returns the input type.
     *
     * @since 1.0.0
     *
     * @return string The input type.
     */
    abstract protected function getType();

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    abstract protected function onSetFormValue($value);

    /**
     * Sets the display value.
     *
     * @since 1.0.0
     *
     * @param mixed $value The value.
     */
    protected function setDisplayValue($value)
    {
        $this->myDisplayValue = $value;
    }

    /**
     * @var mixed My display value.
     */
    private $myDisplayValue;
}
