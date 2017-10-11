<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;

/**
 * Class representing a hidden field.
 *
 * @since 1.0.0
 */
class HiddenField extends AbstractTextInputField
{
    /**
     * Constructs the hidden field.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param string $value The value.
     *
     * @throws \InvalidArgumentException If any of the parameters are of invalid type.
     */
    public function __construct($name, $value = '')
    {
        parent::__construct($name, $value, TextFormatOptions::NONE);
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
        // Hide required from displaying.
        $attributes['required'] = null;

        return parent::getHtml($attributes);
    }

    /**
     * Returns the value of the hidden field.
     *
     * @since 1.0.0
     *
     * @return string The value of the hidden field.
     */
    public function getValue()
    {
        return $this->getText();
    }

    /**
     * Returns the input type.
     *
     * @since 1.0.0
     *
     * @return string The input type.
     */
    protected function getType()
    {
        return 'hidden';
    }
}
