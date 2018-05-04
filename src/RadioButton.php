<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\RadioButtonInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a radio button.
 *
 * @since 1.0.0
 */
class RadioButton implements RadioButtonInterface
{
    use BuildTagTrait;

    /**
     * Constructs the radio button.
     *
     * @since 1.0.0
     *
     * @param string $value The value.
     * @param string $label The label.
     */
    public function __construct(string $value, string $label = '')
    {
        $this->value = $value;
        $this->label = $label;
        $this->name = '';
        $this->isSelected = false;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = []): string
    {
        return self::buildTag('input', null,
            array_merge(
                [
                    'type'    => 'radio',
                    'name'    => $this->name !== '' ? $this->name : false,
                    'value'   => $this->value,
                    'checked' => $this->isSelected,
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
     * Returns the name.
     *
     * @since 1.0.0
     *
     * @return string The name.
     */
    public function getName(): string
    {
        return $this->name;
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
     * Returns true if radio button is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if radio button is selected, false otherwise.
     */
    public function isSelected(): bool
    {
        return $this->isSelected;
    }

    /**
     * Sets the name.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Sets whether this radio button is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if radio button is selected, false otherwise.
     */
    public function setSelected(bool $isSelected): void
    {
        $this->isSelected = $isSelected;
    }

    /**
     * Returns the radio button as a string.
     *
     * @since 1.0.0
     *
     * @return string The radio button as a string.
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
     * @var string My name.
     */
    private $name;

    /**
     * @var bool True if this radio button is selected, false otherwise.
     */
    private $isSelected;
}
