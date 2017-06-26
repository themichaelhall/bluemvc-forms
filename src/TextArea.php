<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Class representing a text area.
 *
 * @since 1.0.0
 */
class TextArea implements FormElementInterface
{
    /**
     * Constructs the text area.
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
        $this->myIsRequired = true;
        $this->myIsValid = true;
    }

    /**
     * Returns the value of the text area.
     *
     * @since 1.0.0
     *
     * @return string The value of the text area.
     */
    public function getValue()
    {
        return $this->myValue;
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
        return self::buildTag('textarea', $this->myValue,
            array_merge(
                [
                    'name'     => $this->myName,
                    'required' => $this->myIsRequired,
                ],
                $attributes
            )
        );
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
        return $this->myValue === '';
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
     * Called when form element should be validated.
     *
     * @since 1.0.0
     */
    public function onValidate()
    {
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
     * @param string      $name       The name.
     * @param string|null $content    The content or null if no content.
     * @param array       $attributes The attributes.
     *
     * @return string The tag.
     */
    protected static function buildTag($name, $content = null, $attributes = [])
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

        $result .= '>';

        if ($content !== null) {
            $result .= htmlspecialchars($content) . '</' . htmlspecialchars($name) . '>';
        }

        return $result;
    }

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

    /**
     * @var string My name.
     */
    private $myName;

    /**
     * @var string My value.
     */
    private $myValue;
}
