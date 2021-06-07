<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Base;

use BlueMvc\Core\Collections\CustomItemCollection;
use BlueMvc\Core\Traits\CustomItemsTrait;
use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Abstract class representing a form element.
 *
 * @since 1.0.0
 */
abstract class AbstractFormElement implements FormElementInterface
{
    use CustomItemsTrait;

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    abstract public function getHtml(array $attributes = []): string;

    /**
     * Returns the custom data.
     *
     * @deprecated Use getCustomItem instead.
     * @since      2.1.0
     *
     * @return mixed|null The custom data or null if no custom data is set.
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * Returns the element error or null if element has no error.
     *
     * @since 1.0.0
     *
     * @return string|null The element error or null if element has no error.
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Returns the label.
     *
     * @since 2.1.0
     *
     * @return string The label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Returns the element name.
     *
     * @since 1.0.0
     *
     * @return string The element name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns true if element has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element has an error, false otherwise.
     */
    public function hasError(): bool
    {
        return $this->error !== null;
    }

    /**
     * Returns true if element is disabled, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if element is disabled, false otherwise.
     */
    public function isDisabled(): bool
    {
        return $this->isDisabled;
    }

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    abstract public function isEmpty(): bool;

    /**
     * Returns true if element value is required, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is required, false otherwise.
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * Sets the custom data.
     *
     * @deprecated Use setCustomItem instead.
     * @since      2.1.0
     *
     * @param mixed|null $customData The custom data.
     */
    public function setCustomData($customData): void
    {
        $this->customData = $customData;
    }

    /**
     * Sets whether element value is required.
     *
     * @since 1.0.0
     *
     * @param bool $isRequired True if element value is required, false otherwise.
     */
    public function setRequired(bool $isRequired): void
    {
        $this->isRequired = $isRequired;
    }

    /**
     * Sets the element error.
     *
     * @since 1.0.0
     *
     * @param string $error The element error.
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * Sets whether the element is disabled.
     *
     * @since 2.2.0
     *
     * @param bool $isDisabled True if the element is disabled, false otherwise.
     */
    public function setDisabled(bool $isDisabled): void
    {
        $this->isDisabled = $isDisabled;
    }

    /**
     * Sets the label.
     *
     * @since 2.1.0
     *
     * @param string $label The label.
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @return string The element html.
     */
    public function __toString(): string
    {
        return $this->getHtml();
    }

    /**
     * Constructs the form element.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     */
    protected function __construct(string $name)
    {
        $this->name = $name;
        $this->error = null;
        $this->isRequired = true;
        $this->label = '';
        $this->customData = null;
        $this->isDisabled = false;
        $this->customItems = new CustomItemCollection();
    }

    /**
     * @var string My name.
     */
    private $name;

    /**
     * @var string|null My error or null if no error.
     */
    private $error;

    /**
     * @var bool If true element value is required, false otherwise.
     */
    private $isRequired;

    /**
     * @var string My label.
     */
    private $label;

    /**
     * @var mixed|null My custom data.
     */
    private $customData;

    /**
     * @var bool If true, element is disabled, false otherwise.
     */
    private $isDisabled;
}
