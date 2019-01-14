<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use BlueMvc\Forms\Interfaces\IntegerFieldInterface;

/**
 * Class representing an integer field.
 *
 * @since 1.0.0
 */
class IntegerField extends AbstractTextInputField implements IntegerFieldInterface
{
    /**
     * Constructs the integer field.
     *
     * @since 1.0.0
     *
     * @param string   $name  The name.
     * @param int|null $value The value.
     */
    public function __construct(string $name, ?int $value = null)
    {
        parent::__construct($name, $value !== null ? strval($value) : '', TextFormatOptions::TRIM);

        $this->isInvalid = false;
        $this->value = $value;
        $this->minimumValue = null;
        $this->maximumValue = null;
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
    public function getHtml(array $attributes = []): string
    {
        if ($this->minimumValue !== null) {
            $attributes['min'] = $this->minimumValue;
        }

        if ($this->maximumValue !== null) {
            $attributes['max'] = $this->maximumValue;
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
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid(): bool
    {
        return $this->isInvalid;
    }

    /**
     * Sets the maximum value.
     *
     * @since 1.0.0
     *
     * @param int $maximumValue The maximum value.
     */
    public function setMaximumValue(int $maximumValue): void
    {
        $this->maximumValue = $maximumValue;
    }

    /**
     * Sets the minimum value.
     *
     * @since 1.0.0
     *
     * @param int $minimumValue The minimum value.
     */
    public function setMinimumValue(int $minimumValue): void
    {
        $this->minimumValue = $minimumValue;
    }

    /**
     * Returns the input type.
     *
     * @since 1.0.0
     *
     * @return string The input type.
     */
    protected function getType(): string
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
    protected function onSetText(string $text): void
    {
        parent::onSetText($text);

        $this->isInvalid = false;
        $this->value = null;

        if ($this->hasError()) {
            return;
        }

        if ($this->isEmpty()) {
            return;
        }

        if (!preg_match('/^[-+]?[0-9]+$/', $text)) {
            $this->setError('Invalid value');
            $this->isInvalid = true;

            return;
        }

        $value = intval($text);

        if ($this->minimumValue !== null && $value < $this->minimumValue || $this->maximumValue !== null && $value > $this->maximumValue) {
            $this->setError('Invalid value');
            $this->isInvalid = true;

            return;
        }

        $this->value = $value;
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $isInvalid;

    /**
     * @var int|null My value.
     */
    private $value;

    /**
     * @var int|null My minimum value.
     */
    private $minimumValue;

    /**
     * @var int|null My maximum value.
     */
    private $maximumValue;
}
