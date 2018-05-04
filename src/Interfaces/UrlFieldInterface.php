<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use DataTypes\Interfaces\UrlInterface;

/**
 * Interface for UrlField class.
 *
 * @since 1.0.0
 */
interface UrlFieldInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the url field.
     *
     * @since 1.0.0
     *
     * @return UrlInterface|null The value of the url field.
     */
    public function getValue(): ?UrlInterface;

    /**
     * Returns true if the value is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the value is invalid, false otherwise.
     */
    public function isInvalid(): bool;
}
