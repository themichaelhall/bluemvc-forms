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
        $this->setValue($value);
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
            $this->setValue(new DateTimeImmutable($text));
        } catch (Exception $exception) {
            $this->setError('Invalid value');
            $this->isInvalid = true;
        }
    }

    /**
     * Sets the value.
     *
     * @param DateTimeImmutable|null $value The value.
     */
    private function setValue(DateTimeImmutable $value = null): void
    {
        if ($value === null) {
            $this->value = null;

            return;
        }

        $this->value = $value->setTime(0, 0);
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $isInvalid;

    /**
     * @var DateTimeImmutable|null My value.
     */
    private $value;
}
