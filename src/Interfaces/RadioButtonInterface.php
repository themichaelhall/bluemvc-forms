<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for RadioButton class.
 *
 * @since 1.0.0
 */
interface RadioButtonInterface
{
    /**
     * Returns the radio button html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The radio button html.
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
     * Returns the radio button as a string.
     *
     * @since 1.0.0
     *
     * @return string The radio button as a string.
     */
    public function __toString();
}
