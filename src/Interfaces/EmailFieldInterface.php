<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use DataTypes\Net\EmailAddressInterface;

/**
 * Interface for EmailField class.
 *
 * @since 1.0.0
 */
interface EmailFieldInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the email field.
     *
     * @since 1.0.0
     *
     * @return EmailAddressInterface|null The value of the email field.
     */
    public function getValue(): ?EmailAddressInterface;

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid(): bool;
}
