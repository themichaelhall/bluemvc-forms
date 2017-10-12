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

        $this->myValue = intval($text);
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $myIsInvalid;

    /**
     * @var int|null My value.
     */
    private $myValue;
}
