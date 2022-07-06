<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Core\Traits\CustomItemsTrait;
use BlueMvc\Forms\Interfaces\FormElementGroupInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;
use BlueMvc\Forms\Traits\FindContainedFormElementsTrait;

/**
 * Class representing a group of form elements.
 *
 * @since 2.2.0
 */
abstract class FormElementGroup implements FormElementGroupInterface
{
    use CustomItemsTrait;
    use FindContainedFormElementsTrait;

    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return array<FormElementInterface|FormElementGroupInterface> The form elements.
     */
    public function getElements(): array
    {
        return $this->findContainedElements();
    }

    /**
     * Returns the error or null if group has no error.
     *
     * @since 2.2.0
     *
     * @return string|null The error or null if group has no error.
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Returns true if group has an error, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if group has an error, false otherwise.
     */
    public function hasError(): bool
    {
        return $this->error !== null;
    }

    /**
     * Sets the error for the group.
     *
     * @since 2.2.0
     *
     * @param string $error The error for the group.
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * Returns the group of elements as html.
     *
     * @since 2.2.0
     *
     * @return string The group of elements as html.
     */
    public function __toString(): string
    {
        return implode('', $this->getElements());
    }

    /**
     * @var string|null The error or null if no error.
     */
    private ?string $error = null;
}
