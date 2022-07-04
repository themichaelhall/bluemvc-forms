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
 * Interface for Option class.
 *
 * @since 1.0.0
 */
interface OptionInterface
{
    /**
     * Returns a custom item by name if it exists, null otherwise.
     *
     * @since 2.2.0
     *
     * @param string $name The custom item name.
     *
     * @return mixed|null The custom item if it exists, null otherwise.
     */
    public function getCustomItem(string $name);

    /**
     * Returns the custom items.
     *
     * @since 2.2.0
     *
     * @return CustomItemCollectionInterface The custom items.
     */
    public function getCustomItems(): CustomItemCollectionInterface;

    /**
     * Returns the option html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The option html.
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
     * Returns the value.
     *
     * @since 1.0.0
     *
     * @return string The value.
     */
    public function getValue(): string;

    /**
     * Returns true if option is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if option is selected, false otherwise.
     */
    public function isSelected(): bool;

    /**
     * Returns true if option is disabled, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if option is disabled, false otherwise.
     */
    public function isDisabled(): bool;

    /**
     * Sets a custom item.
     *
     * @since 2.2.0
     *
     * @param string $name  The custom item name.
     * @param mixed  $value The custom item value.
     */
    public function setCustomItem(string $name, $value): void;

    /**
     * Sets the custom items.
     *
     * @since 2.2.0
     *
     * @param CustomItemCollectionInterface $customItems The custom items.
     */
    public function setCustomItems(CustomItemCollectionInterface $customItems): void;

    /**
     * Sets whether this option is disabled.
     *
     * @since 2.2.0
     *
     * @param bool $isDisabled True if option is disabled, false otherwise.
     */
    public function setDisabled(bool $isDisabled): void;

    /**
     * Sets whether this option is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if option is selected, false otherwise.
     */
    public function setSelected(bool $isSelected): void;

    /**
     * Returns the option as a string.
     *
     * @since 1.0.0
     *
     * @return string The option as a string.
     */
    public function __toString(): string;
}
