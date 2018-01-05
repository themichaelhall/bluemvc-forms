<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

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
    public function getValue();

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid();

    /**
     * Sets the maximum value.
     *
     * @since 1.0.0
     *
     * @param int $maximumValue The maximum value.
     */
    public function setMaximumValue($maximumValue);

    /**
     * Sets the minimum value.
     *
     * @since 1.0.0
     *
     * @param int $minimumValue The minimum value.
     */
    public function setMinimumValue($minimumValue);
}
