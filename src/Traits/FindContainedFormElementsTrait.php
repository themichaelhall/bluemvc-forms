<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Traits;

use BlueMvc\Forms\Interfaces\FormElementGroupInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;

/**
 * Trait for finding form elements contained in the current instance.
 *
 * @since 2.2.0
 */
trait FindContainedFormElementsTrait
{
    /**
     * Adds an element.
     *
     * @since 1.0.0
     *
     * @param FormElementInterface $element The element.
     */
    public function addElement(FormElementInterface $element): void
    {
        $this->extraElements[] = $element;
    }

    /**
     * Adds an element group.
     *
     * @since 2.2.0
     *
     * @param FormElementGroupInterface $elementGroup The element group.
     */
    public function addElementGroup(FormElementGroupInterface $elementGroup): void
    {
        $this->extraElements[] = $elementGroup;
    }

    /**
     * Returns all the contained elements in this instance.
     *
     * @return array<FormElementInterface|FormElementGroupInterface>
     */
    private function findContainedElements(): array
    {
        $result = [];

        foreach (get_object_vars($this) as $element) {
            if ($element instanceof FormElementInterface || $element instanceof FormElementGroupInterface) {
                $result[] = $element;
            }
        }

        return array_merge($result, $this->extraElements);
    }

    /**
     * @var array<FormElementInterface|FormElementGroupInterface> The extra elements.
     */
    private array $extraElements = [];
}
