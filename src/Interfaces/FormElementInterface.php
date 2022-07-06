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
 * Interface for form elements.
 *
 * @since 1.0.0
 */
interface FormElementInterface
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
     * Returns the element error or null if element has no error.
     *
     * @since 1.0.0
     *
     * @return string|null The element error or null if element has no error.
     */
    public function getError(): ?string;

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = []): string;

    /**
     * Returns the label.
     *
     * @since 2.1.0
     *
     * @return string The label.
     */
    public function getLabel(): string;

    /**
     * Returns the element name.
     *
     * @since 1.0.0
     *
     * @return string The element name.
     */
    public function getName(): string;

    /**
     * Returns true if element has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element has an error, false otherwise.
     */
    public function hasError(): bool;

    /**
     * Returns true if element is disabled, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if element is disabled, false otherwise.
     */
    public function isDisabled(): bool;

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty(): bool;

    /**
     * Returns true if element value is required, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is required, false otherwise.
     */
    public function isRequired(): bool;

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
     * Sets the element error.
     *
     * @since 1.0.0
     *
     * @param string $error The element error.
     */
    public function setError(string $error): void;

    /**
     * Sets whether the element is disabled.
     *
     * @since 2.2.0
     *
     * @param bool $isDisabled True if the element is disabled, false otherwise.
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
     * Sets whether element value is required.
     *
     * @since 1.0.0
     *
     * @param bool $isRequired True if element value is required, false otherwise.
     */
    public function setRequired(bool $isRequired): void;

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @return string The element html.
     */
    public function __toString(): string;
}
