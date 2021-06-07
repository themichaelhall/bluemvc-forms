<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for IntegerField class.
 *
 * @since 1.0.0
 */
interface IntegerFieldInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the integer field.
     *
     * @since 1.0.0
     *
     * @return int|null The value of the integer field.
     */
    public function getValue(): ?int;

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid(): bool;

    /**
     * Sets the maximum value.
     *
     * @since 1.0.0
     *
     * @param int $maximumValue The maximum value.
     */
    public function setMaximumValue(int $maximumValue): void;

    /**
     * Sets the minimum value.
     *
     * @since 1.0.0
     *
     * @param int $minimumValue The minimum value.
     */
    public function setMinimumValue(int $minimumValue): void;
}
