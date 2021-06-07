<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for CheckBox class.
 *
 * @since 1.0.0
 */
interface CheckBoxInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the checkbox.
     *
     * @since 1.0.0
     *
     * @return bool The value of the checkbox.
     */
    public function getValue(): bool;
}
