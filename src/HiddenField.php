<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use BlueMvc\Forms\Interfaces\HiddenFieldInterface;

/**
 * Class representing a hidden field.
 *
 * @since 1.0.0
 */
class HiddenField extends AbstractTextInputField implements HiddenFieldInterface
{
    /**
     * Constructs the hidden field.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param string $value The value.
     */
    public function __construct(string $name, string $value = '')
    {
        parent::__construct($name, $value);
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
    public function getValue(): string
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
    protected function getType(): string
    {
        return 'hidden';
    }
}
