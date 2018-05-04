<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

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
    public function getHtml(array $attributes = []): string;

    /**
     * Returns the label.
     *
     * @since 1.0.0
     *
     * @return string The label.
     */
    public function getLabel(): string;

    /**
     * Returns the name.
     *
     * @since 1.0.0
     *
     * @return string The name.
     */
    public function getName(): string;

    /**
     * Returns the value.
     *
     * @since 1.0.0
     *
     * @return string The value.
     */
    public function getValue(): string;

    /**
     * Returns true if radio button is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if radio button is selected, false otherwise.
     */
    public function isSelected(): bool;

    /**
     * Sets the name.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     */
    public function setName(string $name): void;

    /**
     * Sets whether this radio button is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if radio button is selected, false otherwise.
     */
    public function setSelected(bool $isSelected): void;

    /**
     * Returns the radio button as a string.
     *
     * @since 1.0.0
     *
     * @return string The radio button as a string.
     */
    public function __toString(): string;
}
