<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use DateTimeImmutable;

/**
 * Interface for DateTimeField class.
 *
 * @since 1.0.0
 */
interface DateTimeFieldInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the date time field.
     *
     * @since 1.0.0
     *
     * @return DateTimeImmutable|null The value of the date time field.
     */
    public function getValue(): ?DateTimeImmutable;

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid(): bool;
}
