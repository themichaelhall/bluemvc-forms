<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for Option class.
 *
 * @since 1.0.0
 */
interface OptionInterface
{
    /**
     * Returns the option html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The option html.
     */
    public function getHtml(array $attributes = []);

    /**
     * Returns the option as a string.
     *
     * @since 1.0.0
     *
     * @return string The option as a string.
     */
    public function __toString();
}
