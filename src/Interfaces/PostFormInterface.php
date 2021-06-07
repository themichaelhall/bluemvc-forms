<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for PostForm class.
 *
 * @since 1.0.0
 */
interface PostFormInterface extends FormInterface
{
    /**
     * Returns true if check origin is enabled, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if check origin is enabled, false otherwise.
     */
    public function isCheckOriginEnabled(): bool;

    /**
     * Sets whether check origin is enabled.
     *
     * @since 1.0.0
     *
     * @param bool $checkOriginEnabled True if check origin is enabled, false otherwise.
     */
    public function setCheckOriginEnabled(bool $checkOriginEnabled): void;
}
