<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\OptionInterface;

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
     */
    public function __construct($value, $label)
    {
        $this->myValue = $value;
        $this->myLabel = $label;
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
