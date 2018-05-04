<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use BlueMvc\Forms\Interfaces\TextFieldInterface;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField extends AbstractTextInputField implements TextFieldInterface
{
    /**
     * Constructs the text field.
     *
     * @since 1.0.0
     *
     * @param string $name              The name.
     * @param string $value             The value.
     * @param int    $textFormatOptions The text format options.
     */
    public function __construct(string $name, string $value = '', int $textFormatOptions = TextFormatOptions::TRIM | TextFormatOptions::COMPACT)
    {
        parent::__construct($name, $value, $textFormatOptions);
    }

    /**
     * Returns the value of the text field.
     *
     * @since 1.0.0
     *
     * @return string The value of the text field.
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
        return 'text';
    }
}
