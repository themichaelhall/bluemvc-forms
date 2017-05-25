<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Abstract class representing an input type="..." field.
 *
 * @since 1.0.0
 */
abstract class AbstractInputField implements FormElementInterface
{
    /**
     * Returns the element error or null if element has no error.
     *
     * @since 1.0.0
     *
     * @return string|null The element error or null if element has no error.
     */
    public function getError()
    {
        return $this->myError;
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
        return self::buildTag('input',
            array_merge(
                [
                    'type'     => $this->getType(),
                    'name'     => $this->myName,
                    'value'    => $this->myDisplayValue,
                    'required' => $this->myIsRequired,
                ],
                $attributes
            )
        );
    }

    /**
     * Returns the element name.
     *
     * @since 1.0.0
     *
     * @return string The element name.
     */
    public function getName()
    {
        return $this->myName;
    }

    /**
     * Returns true if element has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element has an error, false otherwise.
     */
    public function hasError()
    {
        return $this->myError !== null;
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
        return $this->myDisplayValue === '';
    }

    /**
     * Returns true if element value is required, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is required, false otherwise.
     */
    public function isRequired()
    {
        return $this->myIsRequired;
    }

    /**
     * Returns true if element value is valid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is valid, false otherwise.
     */
    public function isValid()
    {
        return $this->myIsValid;
    }

    /**
     * Sets the element error.
     *
     * @since 1.0.0
     *
     * @param string $error The element error.
     *
     * @throws \InvalidArgumentException If the $error parameter is not a string.
     */
    public function setError($error)
    {
        if (!is_string($error)) {
            throw new \InvalidArgumentException('$error parameter is not a string.');
        }

        $this->myError = $error;
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
     * Sets whether element value is required.
     *
     * @since 1.0.0
     *
     * @param bool $isRequired True if element value is required, false otherwise.
     *
     * @throws \InvalidArgumentException If the $isRequired parameter is not a boolean.
     */
    public function setRequired($isRequired)
    {
        if (!is_bool($isRequired)) {
            throw new \InvalidArgumentException('$isRequired parameter is not a boolean.');
        }

        $this->myIsRequired = $isRequired;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @return string The element html.
     */
    public function __toString()
    {
        return $this->getHtml();
    }

    /**
     * Constructs the input field.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param string $value The value to display in input field.
     *
     * @throws \InvalidArgumentException If any of the $name or $value parameters is not a string.
     */
    protected function __construct($name, $value = '')
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name parameter is not a string.');
        }

        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        $this->myName = $name;
        $this->myDisplayValue = $value;
        $this->myError = null;
        $this->myIsRequired = true;
        $this->myIsValid = true;
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
     * @param string $value The value.
     */
    protected function setDisplayValue($value)
    {
        $this->myDisplayValue = $value;
    }

    /**
     * Sets whether element value is valid.
     *
     * @since 1.0.0
     *
     * @param bool $isValid True if element value is valid, false otherwise.
     */
    protected function setValid($isValid)
    {
        $this->myIsValid = $isValid;
    }

    /**
     * Builds a tag from a name and attributes array.
     *
     * @since 1.0.0
     *
     * @param string $name       The name.
     * @param array  $attributes The attributes.
     *
     * @return string The tag.
     */
    protected static function buildTag($name, $attributes = [])
    {
        $result = '<' . htmlspecialchars($name);
        foreach ($attributes as $attributeName => $attributeValue) {
            if ($attributeValue === null || $attributeValue === false || $attributeValue === '') {
                continue;
            }

            $result .= ' ' . htmlspecialchars($attributeName);
            if ($attributeValue === true) {
                continue;
            }

            $result .= '="' . htmlspecialchars($attributeValue) . '"';
        }

        return $result . '>';
    }

    /**
     * @var string My name.
     */
    private $myName;

    /**
     * @var string My display value.
     */
    private $myDisplayValue;

    /**
     * @var string|null My error or null if no error.
     */
    private $myError;

    /**
     * @var bool If true element value is required, false otherwise.
     */
    private $myIsRequired;

    /**
     * @var bool If true element valid is valid, false otherwise.
     */
    private $myIsValid;
}
