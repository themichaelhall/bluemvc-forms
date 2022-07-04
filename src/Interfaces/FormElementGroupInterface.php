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
 * Interface for a group of form elements.
 *
 * @since 2.2.0
 */
interface FormElementGroupInterface
{
    /**
     * Adds a form element.
     *
     * @since 2.2.0
     *
     * @param FormElementInterface $element The form element.
     */
    public function addElement(FormElementInterface $element): void;

    /**
     * Adds an element group.
     *
     * @since 2.2.0
     *
     * @param FormElementGroupInterface $elementGroup The element group.
     */
    public function addElementGroup(FormElementGroupInterface $elementGroup): void;

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
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return array<FormElementInterface|FormElementGroupInterface> The form elements.
     */
    public function getElements(): array;

    /**
     * Returns the error or null if group has no error.
     *
     * @since 2.2.0
     *
     * @return string|null The error or null if group has no error.
     */
    public function getError(): ?string;

    /**
     * Returns true if group has an error, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if group has an error, false otherwise.
     */
    public function hasError(): bool;

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
     * Sets the error for the group.
     *
     * @since 2.2.0
     *
     * @param string $error The error for the group.
     */
    public function setError(string $error): void;

    /**
     * Returns the group of elements as html.
     *
     * @since 2.2.0
     *
     * @return string The group of elements as html.
     */
    public function __toString(): string;
}
