<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractInputField;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField extends AbstractInputField
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
        parent::__construct($name, $value);

        $this->myIsRequired = true;
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
        return $this->buildTag('input',
            array_merge(
                [
                    'type'     => 'text',
                    'name'     => $this->getName(),
                    'value'    => $this->getValue() !== '' ? $this->getValue() : false,
                    'required' => $this->myIsRequired,
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
        return $this->getValue() === '';
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
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
        $this->setValue(trim($value));
    }

    /**
     * @var bool If true element value is required, false otherwise.
     */
    private $myIsRequired;
}
