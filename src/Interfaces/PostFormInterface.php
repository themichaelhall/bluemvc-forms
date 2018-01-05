<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

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
    public function isCheckOriginEnabled();

    /**
     * Sets whether check origin is enabled.
     *
     * @since 1.0.0
     *
     * @param bool $checkOriginEnabled True if check origin is enabled, false otherwise.
     *
     * @throws \InvalidArgumentException If the $checkOriginEnabled parameter is not a boolean.
     */
    public function setCheckOriginEnabled($checkOriginEnabled);
}
