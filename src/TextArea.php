<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextElement;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a text area.
 *
 * @since 1.0.0
 */
class TextArea extends AbstractTextElement
{
    use BuildTagTrait;

    /**
     * Constructs the text area.
     *
     * @since 1.0.0
     *
     * @param string $name              The name.
     * @param string $value             The value.
     * @param int    $textFormatOptions The text format options.
     *
     * @throws \InvalidArgumentException If any of the parameters are of invalid type.
     */
    public function __construct($name, $value = '', $textFormatOptions = TextFormatOptions::TRIM | TextFormatOptions::COMPACT | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT_LINES)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        parent::__construct($name, $value, $textFormatOptions);
    }

    /**
     * Returns the value of the text area.
     *
     * @since 1.0.0
     *
     * @return string The value of the text area.
     */
    public function getValue()
    {
        return $this->getText();
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
        return self::myBuildTag('textarea', $this->getText(),
            array_merge(
                [
                    'name'     => $this->getName(),
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
    }
}
