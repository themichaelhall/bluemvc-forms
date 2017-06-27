<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Abstract class representing a form element.
 *
 * @since 1.0.0
 */
abstract class AbstractFormElement implements FormElementInterface
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
    abstract public function getHtml(array $attributes = []);

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
    abstract public function isEmpty();

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
     * Sets the value from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     *
     * @throws \InvalidArgumentException If the $value parameter is not a string.
     */
    abstract public function setFormValue($value);

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
     * Constructs the form element.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    protected function __construct($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name parameter is not a string.');
        }

        $this->myName = $name;
        $this->myError = null;
        $this->myIsRequired = true;
        $this->myIsValid = true;
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
     * @var string My name.
     */
    private $myName;

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
