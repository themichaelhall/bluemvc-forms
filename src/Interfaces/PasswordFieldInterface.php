<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for PasswordField class.
 *
 * @since 1.0.0
 */
interface PasswordFieldInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the password field.
     *
     * @since 1.0.0
     *
     * @return string The value of the password field.
     */
    public function getValue();
}
