<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;

/**
 * Class representing an integer field.
 *
 * @since 1.0.0
 */
class IntegerField extends AbstractTextInputField
{
    /**
     * Constructs the integer field.
     *
     * @since 1.0.0
     *
     * @param string   $name  The name.
     * @param int|null $value The value.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function __construct($name, $value = null)
    {
        parent::__construct($name, $value !== null ? strval($value) : '', TextFormatOptions::TRIM);

        $this->myIsInvalid = false;
        $this->myValue = $value;
        $this->myMinimumValue = null;
        $this->myMaximumValue = null;
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
        if ($this->myMinimumValue !== null) {
            $attributes['min'] = $this->myMinimumValue;
        }

        if ($this->myMaximumValue !== null) {
            $attributes['max'] = $this->myMaximumValue;
        }

        return parent::getHtml($attributes);
    }

    /**
     * Returns the value of the integer field.
     *
     * @since 1.0.0
     *
     * @return int|null The value of the integer field.
     */
    public function getValue()
    {
        return $this->myValue;
    }

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid()
    {
        return $this->myIsInvalid;
    }

    /**
     * Sets the maximum value.
     *
     * @since 1.0.0
     *
     * @param int $maximumValue The maximum value.
     *
     * @throws \InvalidArgumentException If the $maximumValue parameter is not an integer.
     */
    public function setMaximumValue($maximumValue)
    {
        if (!is_int($maximumValue)) {
            throw new \InvalidArgumentException('$maximumValue parameter is not an integer.');
        }

        $this->myMaximumValue = $maximumValue;
    }

    /**
     * Sets the minimum value.
     *
     * @since 1.0.0
     *
     * @param int $minimumValue The minimum value.
     *
     * @throws \InvalidArgumentException If the $minimumValue parameter is not an integer.
     */
    public function setMinimumValue($minimumValue)
    {
        if (!is_int($minimumValue)) {
            throw new \InvalidArgumentException('$minimumValue parameter is not an integer.');
        }

        $this->myMinimumValue = $minimumValue;
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
        return 'number';
    }

    /**
     * Called when text is set from form.
     *
     * @since 1.0.0
     *
     * @param string $text The text from form.
     */
    protected function onSetText($text)
    {
        parent::onSetText($text);

        $this->myIsInvalid = false;
        $this->myValue = null;

        if ($this->hasError()) {
            return;
        }

        if ($this->isEmpty()) {
            return;
        }

        if (!preg_match('/^[-+]?[0-9]+$/', $text)) {
            $this->setError('Invalid value');
            $this->myIsInvalid = true;

            return;
        }

        $value = intval($text);

        if ($this->myMinimumValue !== null && $value < $this->myMinimumValue || $this->myMaximumValue !== null && $value > $this->myMaximumValue) {
            $this->setError('Invalid value');
            $this->myIsInvalid = true;

            return;
        }

        $this->myValue = $value;
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $myIsInvalid;

    /**
     * @var int|null My value.
     */
    private $myValue;

    /**
     * @var int|null My minimum value.
     */
    private $myMinimumValue;

    /**
     * @var int|null My maximum value.
     */
    private $myMaximumValue;
}
