<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for elements that handles a form value.
 *
 * @since 1.0.0
 */
interface SetFormValueElementInterface extends FormElementInterface
{
    /**
     * Sets the value from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    public function setFormValue(string $value): void;
}
