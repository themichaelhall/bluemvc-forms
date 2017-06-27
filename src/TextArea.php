<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractFormElement;

/**
 * Class representing a text area.
 *
 * @since 1.0.0
 */
class TextArea extends AbstractFormElement
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
        parent::__construct($name);

        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        $this->myValue = $value;
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
                    'name'     => $this->getName(),
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
        return $this->myValue === '';
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
     * @var string My value.
     */
    private $myValue;
}
