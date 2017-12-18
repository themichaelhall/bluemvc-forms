<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

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
     *
     * @throws \InvalidArgumentException If any of the parameters is not a string.
     */
    public function __construct($value, $label = '')
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        if (!is_string($label)) {
            throw new \InvalidArgumentException('$label parameter is not a string.');
        }

        $this->myValue = $value;
        $this->myLabel = $label;
        $this->myName = '';
        $this->myIsSelected = false;
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
    public function getHtml(array $attributes = [])
    {
        return self::myBuildTag('input', null,
            array_merge(
                [
                    'type'    => 'radio',
                    'name'    => $this->myName !== '' ? $this->myName : null,
                    'value'   => $this->myValue,
                    'checked' => $this->myIsSelected,
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
    public function getLabel()
    {
        return $this->myLabel;
    }

    /**
     * Returns the name.
     *
     * @since 1.0.0
     *
     * @return string The name.
     */
    public function getName()
    {
        return $this->myName;
    }

    /**
     * Returns the value.
     *
     * @since 1.0.0
     *
     * @return string The value.
     */
    public function getValue()
    {
        return $this->myValue;
    }

    /**
     * Returns true if radio button is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if radio button is selected, false otherwise.
     */
    public function isSelected()
    {
        return $this->myIsSelected;
    }

    /**
     * Sets the name.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name parameter is not a string.');
        }

        $this->myName = $name;
    }

    /**
     * Sets whether this radio button is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if radio button is selected, false otherwise.
     *
     * @throws \InvalidArgumentException If the $isSelected parameter is not a boolean.
     */
    public function setSelected($isSelected)
    {
        if (!is_bool($isSelected)) {
            throw new \InvalidArgumentException('$isSelected parameter is not a boolean.');
        }

        $this->myIsSelected = $isSelected;
    }

    /**
     * Returns the radio button as a string.
     *
     * @since 1.0.0
     *
     * @return string The radio button as a string.
     */
    public function __toString()
    {
        return $this->getHtml();
    }

    /**
     * @var string My value.
     */
    private $myValue;

    /**
     * @var string My label.
     */
    private $myLabel;

    /**
     * @var string My name.
     */
    private $myName;

    /**
     * @var bool True if this radio button is selected, false otherwise.
     */
    private $myIsSelected;
}
