<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Abstract class representing an input type="..." field.
 *
 * @since 1.0.0
 */
abstract class AbstractTextInputField extends AbstractTextElement
{
    use BuildTagTrait;

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
                    'type'     => $this->getType(),
                    'name'     => $this->getName(),
                    'value'    => $this->getText() !== '' ? $this->getText() : false,
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
    }

    /**
     * Returns the input type.
     *
     * @since 1.0.0
     *
     * @return string The input type.
     */
    abstract protected function getType();

    /**
     * Returns true if this text element is multi-line, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if this text element is multi-line, false otherwise.
     */
    protected function isMultiLine()
    {
        return false;
    }
}
