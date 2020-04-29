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
        /** @noinspection PhpDeprecationInspection */
        $this->onSetFormValue($value);

        if ($this->isEmpty() && $this->isRequired() && !$this->hasError()) {
            $this->setError('Missing value');
        }
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     *
     * @deprecated This method will be declared abstract in next major version.
     */
    protected function onSetFormValue(string $value): void
    {
    }
}
