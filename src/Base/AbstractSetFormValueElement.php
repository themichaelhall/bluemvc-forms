<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\Interfaces\SetFormValueElementInterface;

/**
 * Abstract class representing an element that handles a form value.
 *
 * @since 1.0.0
 */
abstract class AbstractSetFormValueElement extends AbstractFormElement implements SetFormValueElementInterface
{
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

        $this->onSetFormValue($value);
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue(
        /** @noinspection PhpUnusedParameterInspection */
        $value
    ) {
        if ($this->isEmpty() && $this->isRequired()) {
            $this->setError('Missing value');

            return;
        }
    }
}
