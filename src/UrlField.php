<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextInputField;
use DataTypes\Interfaces\UrlInterface;
use DataTypes\Url;

/**
 * Class representing a url field.
 *
 * @since 1.0.0
 */
class UrlField extends AbstractTextInputField
{
    /**
     * Constructs the url field.
     *
     * @since 1.0.0
     *
     * @param string            $name  The name.
     * @param UrlInterface|null $value The value.
     *
     * @throws \InvalidArgumentException If any the $name parameter is not a string.
     */
    public function __construct($name, UrlInterface $value = null)
    {
        parent::__construct($name, $value !== null ? $value->__toString() : '', TextFormatOptions::TRIM);

        $this->myValue = $value;
    }

    /**
     * Returns the value of the url field.
     *
     * @since 1.0.0
     *
     * @return UrlInterface|null The value of the url field.
     */
    public function getValue()
    {
        return $this->myValue;
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
        return 'url';
    }

    /**
     * Called when text is set from form.
     *
     * @since 1.0.0
     *
     * @param string $text The text from form.
     */
    protected function onSetText($text)
    {
        parent::onSetText($text);

        $this->myValue = Url::tryParse($text);

        if ($this->myValue === null) {
            $this->setError('Invalid value');
        }
    }

    /**
     * @var UrlInterface|null My value.
     */
    private $myValue;
}
