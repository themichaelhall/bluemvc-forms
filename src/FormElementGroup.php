<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Core\Traits\CustomItemsTrait;
use BlueMvc\Forms\Interfaces\FormElementGroupInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Class representing a group of form elements.
 *
 * @since 2.2.0
 */
class FormElementGroup implements FormElementGroupInterface
{
    use CustomItemsTrait;

    /**
     * Constructs the group of form elements.
     *
     * @since 2.2.0
     */
    public function __construct()
    {
        $this->customData = null;
        $this->elements = [];
        $this->error = null;
        $this->customItems = new CustomItemCollection();
    }

    /**
     * Adds a form element.
     *
     * @since 2.2.0
     *
     * @param FormElementInterface $element The form element.
     */
    public function addElement(FormElementInterface $element): void
    {
        $this->elements[] = $element;
    }

    /**
     * Returns the custom data or null if no custom data is set.
     *
     * @deprecated Use getCustomItem instead.
     * @since      2.2.0
     *
     * @return mixed|null The custom data or null if no custom data is set.
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return FormElementInterface[] The form elements.
     */
    public function getElements(): array
    {
        return $this->elements;
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
     * Sets the custom data.
     *
     * @deprecated Use setCustomItem instead.
     * @since      2.2.0
     *
     * @param mixed|null $customData The custom data.
     */
    public function setCustomData($customData): void
    {
        $this->customData = $customData;
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
        return implode('', $this->elements);
    }

    /**
     * @var mixed|null My custom data or null if no custom data is set.
     */
    private $customData;

    /**
     * @var FormElementInterface[] My form elements.
     */
    private $elements;

    /**
     * @var string|null My error or null if no error.
     */
    private $error;
}
