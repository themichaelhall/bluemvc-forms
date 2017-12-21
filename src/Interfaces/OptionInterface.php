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
     * Returns the label.
     *
     * @since 1.0.0
     *
     * @return string The label.
     */
    public function getLabel();

    /**
     * Returns the value.
     *
     * @since 1.0.0
     *
     * @return string The value.
     */
    public function getValue();

    /**
     * Returns true if option is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if option is selected, false otherwise.
     */
    public function isSelected();

    /**
     * Sets whether this option is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if option is selected, false otherwise.
     */
    public function setSelected($isSelected);

    /**
     * Returns the option as a string.
     *
     * @since 1.0.0
     *
     * @return string The option as a string.
     */
    public function __toString();
}
