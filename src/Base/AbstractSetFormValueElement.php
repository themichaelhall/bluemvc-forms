<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

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
     */
    public function setFormValue(string $value): void
    {
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
        string $value
    ): void {
        if ($this->isEmpty() && $this->isRequired()) {
            $this->setError('Missing value');

            return;
        }
    }
}
