<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\FormElementGroupInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Class representing a group of form elements.
 *
 * @since 2.2.0
 */
class FormElementGroup implements FormElementGroupInterface
{
    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return FormElementInterface[] The form elements.
     */
    public function getElements(): array
    {
        return [];
    }
}
