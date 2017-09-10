<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

/**
 * Abstract class representing an input type="..." field.
 *
 * @since 1.0.0
 */
abstract class AbstractTextInputField extends AbstractTextElement
{
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
        return self::buildTag('input', null,
            array_merge(
                [
                    'type'     => $this->getType(),
                    'name'     => $this->getName(),
                    'value'    => $this->myText,
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
    }

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty()
    {
        return $this->myText === '';
    }

    /**
     * Sets the value from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     *
     * @throws \InvalidArgumentException If the $value parameter is not a string.
     */
    public function setFormValue($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        $this->myText = $this->formatText($value);
        $this->onSetFormValue($this->myText);
    }

    /**
     * Constructs the input field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     * @param string $text The value to display in input field.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    protected function __construct($name, $text)
    {
        parent::__construct($name);

        $this->myText = $this->formatText($text);
    }

    /**
     * Returns the value to dipslay in input field.
     *
     * @since 1.0.0
     *
     * @return string The value to display in input field.
     */
    protected function getText()
    {
        return $this->myText;
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
     * Formats the text.
     *
     * @since 1.0.0
     *
     * @param string $text The text.
     *
     * @return string The formatted text.
     */
    protected function formatText($text)
    {
        return $text;
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
    }

    /**
     * @var string My text to display in input form.
     */
    private $myText;
}
