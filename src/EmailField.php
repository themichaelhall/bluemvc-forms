<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use BlueMvc\Forms\Interfaces\EmailFieldInterface;
use DataTypes\EmailAddress;
use DataTypes\Interfaces\EmailAddressInterface;

/**
 * Class representing an email field.
 *
 * @since 1.0.0
 */
class EmailField extends AbstractTextInputField implements EmailFieldInterface
{
    /**
     * Constructs the email field.
     *
     * @since 1.0.0
     *
     * @param string                     $name  The name.
     * @param EmailAddressInterface|null $value The value.
     */
    public function __construct(string $name, ?EmailAddressInterface $value = null)
    {
        parent::__construct($name, $value !== null ? $value->__toString() : '', TextFormatOptions::TRIM);

        $this->isInvalid = false;
        $this->value = $value;
    }

    /**
     * Returns the value of the email field.
     *
     * @since 1.0.0
     *
     * @return EmailAddressInterface|null The value of the email field.
     */
    public function getValue(): ?EmailAddressInterface
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
        return 'email';
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

        $this->value = EmailAddress::tryParse($text);

        if ($this->value === null) {
            $this->setError('Invalid value');
            $this->isInvalid = true;
        }
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $isInvalid;

    /**
     * @var EmailAddressInterface|null My value.
     */
    private $value;
}
