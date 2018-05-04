<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

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
     *
     * @throws \InvalidArgumentException If any of the parameters is not a string.
     */
    public function __construct($value, $label)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        if (!is_string($label)) {
            throw new \InvalidArgumentException('$label parameter is not a string.');
        }

        $this->myValue = $value;
        $this->myLabel = $label;
        $this->myIsSelected = false;
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
    public function getHtml(array $attributes = [])
    {
        return self::buildTag('option', $this->getLabel(),
            array_merge(
                [
                    'value'    => $this->getValue(),
                    'selected' => $this->myIsSelected,
                ],
                $attributes)
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
     * Returns true if option is selected, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if option is selected, false otherwise.
     */
    public function isSelected()
    {
        return $this->myIsSelected;
    }

    /**
     * Sets whether this option is selected.
     *
     * @since 1.0.0
     *
     * @param bool $isSelected True if option is selected, false otherwise.
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
     * Returns the option as a string.
     *
     * @since 1.0.0
     *
     * @return string The option as a string.
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
     * @var bool True if this option is selected, false otherwise.
     */
    private $myIsSelected;
}
