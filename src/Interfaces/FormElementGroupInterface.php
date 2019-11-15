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
     * Adds a form element.
     *
     * @since 2.2.0
     *
     * @param FormElementInterface $element The form element.
     */
    public function addElement(FormElementInterface $element): void;

    /**
     * Returns the form elements.
     *
     * @since 2.2.0
     *
     * @return FormElementInterface[] The form elements.
     */
    public function getElements(): array;

    /**
     * Returns the group of elements as html.
     *
     * @since 2.2.0
     *
     * @return string The group of elements as html.
     */
    public function __toString(): string;
}
