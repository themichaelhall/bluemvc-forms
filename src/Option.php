<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\OptionInterface;
use Prophecy\Exception\InvalidArgumentException;

/**
 * Class representing a select option.
 *
 * @since 1.0.0
 */
class Option implements OptionInterface
{
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
            throw new InvalidArgumentException('$value parameter is not a string.');
        }

        if (!is_string($label)) {
            throw new InvalidArgumentException('$label parameter is not a string.');
        }

        $this->myValue = $value;
        $this->myLabel = $label;
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
        // fixme: Use buildTag.
        return '<option value="' . $this->myValue . '">' . $this->myLabel . '</option>';
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
}
