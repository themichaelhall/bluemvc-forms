<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use BlueMvc\Forms\Interfaces\DateFieldInterface;
use DateTimeImmutable;
use Exception;

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
     * @param string                 $name  The name.
     * @param DateTimeImmutable|null $value The value.
     */
    public function __construct(string $name, ?DateTimeImmutable $value = null)
    {
        parent::__construct($name, $value !== null ? $value->format('Y-m-d') : '', TextFormatOptions::TRIM);

        $this->isInvalid = false;
        $this->value = self::toZeroTime($value);
        $this->minimumValue = null;
        $this->maximumValue = null;
    }

    /**
     * Returns the element html.
     *
     * @since 3.1.0
     *
     * @param array<string|int, mixed> $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = []): string
    {
        if ($this->minimumValue !== null) {
            $attributes['min'] = $this->minimumValue->format('Y-m-d');
        }

        if ($this->maximumValue !== null) {
            $attributes['max'] = $this->maximumValue->format('Y-m-d');
        }

        return parent::getHtml($attributes);
    }

    /**
     * Returns the value of the date field.
     *
     * @since 1.0.0
     *
     * @return DateTimeImmutable|null The value of the date field.
     */
    public function getValue(): ?DateTimeImmutable
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
     * @since 3.1.0
     *
     * @param DateTimeImmutable $maximumValue The maximum value.
     */
    public function setMaximumValue(DateTimeImmutable $maximumValue): void
    {
        $this->maximumValue = self::toZeroTime($maximumValue);
    }

    /**
     * Sets the minimum value.
     *
     * @since 3.1.0
     *
     * @param DateTimeImmutable $minimumValue The minimum value.
     */
    public function setMinimumValue(DateTimeImmutable $minimumValue): void
    {
        $this->minimumValue = self::toZeroTime($minimumValue);
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
        return 'date';
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

        if ($this->isEmpty()) {
            return;
        }

        try {
            $value = self::toZeroTime(new DateTimeImmutable($text));
        } catch (Exception) {
            $this->setError('Invalid value');
            $this->isInvalid = true;

            return;
        }

        if ($this->minimumValue !== null && $value < $this->minimumValue || $this->maximumValue !== null && $value > $this->maximumValue) {
            $this->setError('Invalid value');
            $this->isInvalid = true;

            return;
        }

        $this->value = $value;
    }

    /**
     * Sets the time part to zero if value is not null.
     *
     * @param DateTimeImmutable|null $value The value or null.
     *
     * @return DateTimeImmutable|null The value with time set to zero or null.
     */
    private static function toZeroTime(?DateTimeImmutable $value): ?DateTimeImmutable
    {
        if ($value === null) {
            return null;
        }

        return $value->setTime(0, 0);
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private bool $isInvalid;

    /**
     * @var DateTimeImmutable|null The value.
     */
    private ?DateTimeImmutable $value;

    /**
     * @var DateTimeImmutable|null The minimum value.
     */
    private ?DateTimeImmutable $minimumValue;

    /**
     * @var DateTimeImmutable|null The maximum value.
     */
    private ?DateTimeImmutable $maximumValue;
}
