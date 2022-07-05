<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractSetFormValueElement;
use BlueMvc\Forms\Interfaces\CheckBoxInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a checkbox.
 *
 * @since 1.0.0
 */
class CheckBox extends AbstractSetFormValueElement implements CheckBoxInterface
{
    use BuildTagTrait;

    /**
     * Constructs the checkbox.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param bool   $value The value.
     */
    public function __construct(string $name, bool $value = false)
    {
        parent::__construct($name);

        $this->value = $value;
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
        return self::buildTag(
            'input',
            null,
            array_merge(
                [
                    'type'     => 'checkbox',
                    'name'     => $this->getName(),
                    'checked'  => $this->value,
                    'required' => $this->isRequired(),
                    'disabled' => $this->isDisabled(),
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
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty(): bool
    {
        return !$this->value;
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue(string $value): void
    {
        $this->value = strtolower($value) === 'on';
    }

    /**
     * @var bool My value.
     */
    private $value;
}
