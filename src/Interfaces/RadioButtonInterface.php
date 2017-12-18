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
     * Returns the name.
     *
     * @since 1.0.0
     *
     * @return string The name.
     */
    public function getName();

    /**
     * Returns the value.
     *
     * @since 1.0.0
     *
     * @return string The value.
     */
    public function getValue();

    /**
     * Returns true if radio button is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if radio button is selected, false otherwise.
     */
    public function isSelected();

    /**
     * Sets the name.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     */
    public function setName($name);

    /**
     * Sets whether this radio button is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if radio button is selected, false otherwise.
     */
    public function setSelected($isSelected);

    /**
     * Returns the radio button as a string.
     *
     * @since 1.0.0
     *
     * @return string The radio button as a string.
     */
    public function __toString();
}
