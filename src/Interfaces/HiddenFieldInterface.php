<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for HiddenField class.
 *
 * @since 1.0.0
 */
interface HiddenFieldInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the hidden field.
     *
     * @since 1.0.0
     *
     * @return string The value of the hidden field.
     */
    public function getValue();
}
