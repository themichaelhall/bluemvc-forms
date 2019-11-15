<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for a group of form elements.
 *
 * @since 2.2.0
 */
interface FormElementGroupInterface
{
    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return FormElementInterface[] The form elements.
     */
    public function getElements(): array;
}
