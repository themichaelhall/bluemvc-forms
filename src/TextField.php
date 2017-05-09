<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField implements FormElementInterface
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
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name parameter is not a string.');
        }

        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        $this->myName = $name;
        $this->myValue = $value;
        $this->myError = null;
    }

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
     * @return string The element html.
     */
    public function getHtml()
    {
        return $this->buildTag('input',
            [
                'type'     => 'text',
                'name'     => $this->myName,
                'value'    => $this->myValue !== '' ? $this->myValue : null,
                'required' => true,
            ]
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
        return $this->myValue === '';
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

        $this->myValue = trim($value);
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
     * Builds a tag from a name and attributes array.
     *
     * @since 1.0.0
     *
     * @param string $name       The name.
     * @param array  $attributes The attributes.
     *
     * @return string The tag.
     */
    protected function buildTag($name, $attributes = [])
    {
        $result = '<' . htmlspecialchars($name);
        foreach ($attributes as $attributeName => $attributeValue) {
            if ($attributeValue === null || $attributeValue === false) {
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
     * @var string My value.
     */
    private $myValue;

    /**
     * @var string|null My error or null if no error.
     */
    private $myError;
}
