<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractSetFormValueElement;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a checkbox.
 *
 * @since 1.0.0
 */
class CheckBox extends AbstractSetFormValueElement
{
    use BuildTagTrait;

    /**
     * Constructs the checkbox.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param bool   $value The value.
     *
     * @throws \InvalidArgumentException If any of the $name or $value parameters is not the correct type.
     */
    public function __construct($name, $value = false)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('$value parameter is not a boolean.');
        }

        parent::__construct($name);

        $this->myValue = $value;
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
                    'type'     => 'checkbox',
                    'name'     => $this->getName(),
                    'checked'  => $this->myValue,
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
    }

    /**
     * Returns the value of the checkbox.
     *
     * @since 1.0.0
     *
     * @return bool The value of the checkbox.
     */
    public function getValue()
    {
        return $this->myValue;
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
        return !$this->myValue;
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
        $this->myValue = strtolower($value) === 'on';

        parent::onSetFormValue($value);
    }

    /**
     * @var bool My value.
     */
    private $myValue;
}
