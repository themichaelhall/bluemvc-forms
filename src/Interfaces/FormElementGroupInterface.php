<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

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
     * Returns the custom data or null if no custom data is set.
     *
     * @since 2.2.0
     *
     * @return mixed|null The custom data or null if no custom data is set.
     */
    public function getCustomData();

    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return FormElementInterface[] The form elements.
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
     * Sets the custom data.
     *
     * @since 2.2.0
     *
     * @param mixed|null $customData The custom data.
     */
    public function setCustomData($customData): void;

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
