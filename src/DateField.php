<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use BlueMvc\Forms\Interfaces\DateFieldInterface;

/**
 * Class representing a date field.
 *
 * @since 1.0.0
 */
class DateField extends AbstractTextInputField implements DateFieldInterface
{
    /**
     * Constructs the date field.
     *
     * @since 1.0.0
     *
     * @param string                  $name  The name.
     * @param \DateTimeImmutable|null $value The value.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function __construct($name, \DateTimeImmutable $value = null)
    {
        parent::__construct($name, $value !== null ? $value->format('Y-m-d') : '', TextFormatOptions::TRIM);

        $this->myIsInvalid = false;
        $this->mySetValue($value);
    }

    /**
     * Returns the value of the date field.
     *
     * @since 1.0.0
     *
     * @return \DateTimeImmutable|null The value of the date field.
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
        return 'date';
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

        try {
            $this->mySetValue(new \DateTimeImmutable($text));
        } catch (\Exception $exception) {
            $this->setError('Invalid value');
            $this->myIsInvalid = true;
        }
    }

    /**
     * Sets the value.
     *
     * @param \DateTimeImmutable|null $value The value.
     */
    private function mySetValue(\DateTimeImmutable $value = null)
    {
        if ($value === null) {
            $this->myValue = null;

            return;
        }

        $this->myValue = $value->setTime(0, 0, 0);
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $myIsInvalid;

    /**
     * @var \DateTimeImmutable|null My value.
     */
    private $myValue;
}
