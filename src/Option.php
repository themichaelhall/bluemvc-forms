<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\OptionInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a select option.
 *
 * @since 1.0.0
 */
class Option implements OptionInterface
{
    use BuildTagTrait;

    /**
     * Constructs the option.
     *
     * @since 1.0.0
     *
     * @param string $value The value.
     * @param string $label The label.
     */
    public function __construct(string $value, string $label)
    {
        $this->value = $value;
        $this->label = $label;
        $this->isSelected = false;
        $this->customData = null;
        $this->isDisabled = false;
    }

    /**
     * Returns the custom data.
     *
     * @since 2.1.0
     *
     * @return mixed|null The custom data or null if no custom data is set.
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * Returns the option html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The option html.
     */
    public function getHtml(array $attributes = []): string
    {
        return self::buildTag(
            'option',
            $this->getLabel(),
            array_merge(
                [
                    'value'    => $this->getValue(),
                    'selected' => $this->isSelected,
                    'disabled' => $this->isDisabled,
                ],
                $attributes
            )
        );
    }

    /**
     * Returns the label.
     *
     * @since 1.0.0
     *
     * @return string The label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Returns the value.
     *
     * @since 1.0.0
     *
     * @return string The value.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Returns true if option is disabled, false otherwise.
     *
     * @since 2.2.0
     *
     * @return bool True if option is disabled, false otherwise.
     */
    public function isDisabled(): bool
    {
        return $this->isDisabled;
    }

    /**
     * Returns true if option is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if option is selected, false otherwise.
     */
    public function isSelected(): bool
    {
        return $this->isSelected;
    }

    /**
     * Sets the custom data.
     *
     * @since 2.1.0
     *
     * @param mixed|null $customData The custom data.
     */
    public function setCustomData($customData): void
    {
        $this->customData = $customData;
    }

    /**
     * Sets whether this option is disabled.
     *
     * @since 2.2.0
     *
     * @param bool $isDisabled True if option is disabled, false otherwise.
     */
    public function setDisabled(bool $isDisabled): void
    {
        $this->isDisabled = $isDisabled;
    }

    /**
     * Sets whether this option is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if option is selected, false otherwise.
     */
    public function setSelected(bool $isSelected): void
    {
        $this->isSelected = $isSelected;
    }

    /**
     * Returns the option as a string.
     *
     * @since 1.0.0
     *
     * @return string The option as a string.
     */
    public function __toString(): string
    {
        return $this->getHtml();
    }

    /**
     * @var string My value.
     */
    private $value;

    /**
     * @var string My label.
     */
    private $label;

    /**
     * @var bool True if this option is selected, false otherwise.
     */
    private $isSelected;

    /**
     * @var mixed|null My custom data.
     */
    private $customData;

    /**
     * @var bool True if this options is disabled, false otherwise.
     */
    private $isDisabled;
}
