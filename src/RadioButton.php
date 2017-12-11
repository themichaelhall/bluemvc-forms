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
                    'type'  => 'radio',
                    'value' => $this->myValue,
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
}
