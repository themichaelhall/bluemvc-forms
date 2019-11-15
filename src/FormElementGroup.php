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
     * Constructs the group of form elements.
     *
     * @since 2.2.0
     */
    public function __construct()
    {
        $this->elements = [];
    }

    /**
     * Adds a form element.
     *
     * @since 2.2.0
     *
     * @param FormElementInterface $element The form element.
     */
    public function addElement(FormElementInterface $element): void
    {
        $this->elements[] = $element;
    }

    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return FormElementInterface[] The form elements.
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @var FormElementInterface[] My form elements.
     */
    private $elements;
}
