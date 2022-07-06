<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use BlueMvc\Core\Interfaces\Collections\CustomItemCollectionInterface;

/**
 * Interface for RadioButton class.
 *
 * @since 1.0.0
 */
interface RadioButtonInterface
{
    /**
     * Returns a custom item by name if it exists, null otherwise.
     *
     * @since 2.2.0
     *
     * @param string $name The custom item name.
     *
     * @return mixed The custom item if it exists, null otherwise.
     */
    public function getCustomItem(string $name): mixed;

    /**
     * Returns the custom items.
     *
     * @since 2.2.0
     *
     * @return CustomItemCollectionInterface The custom items.
     */
    public function getCustomItems(): CustomItemCollectionInterface;

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
     * Returns true if radio button is disabled, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if radio button is disabled, false otherwise.
     */
    public function isDisabled(): bool;

    /**
     * Returns true if radio button is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if radio button is selected, false otherwise.
     */
    public function isSelected(): bool;

    /**
     * Sets a custom item.
     *
     * @since 2.2.0
     *
     * @param string $name  The custom item name.
     * @param mixed  $value The custom item value.
     */
    public function setCustomItem(string $name, mixed $value): void;

    /**
     * Sets the custom items.
     *
     * @since 2.2.0
     *
     * @param CustomItemCollectionInterface $customItems The custom items.
     */
    public function setCustomItems(CustomItemCollectionInterface $customItems): void;

    /**
     * Sets whether this radio button is disabled.
     *
     * @since 2.2.0
     *
     * @param bool $isDisabled True if radio button is disabled, false otherwise.
     */
    public function setDisabled(bool $isDisabled): void;

    /**
     * Sets the label.
     *
     * @since 2.1.0
     *
     * @param string $label The label.
     */
    public function setLabel(string $label): void;

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
