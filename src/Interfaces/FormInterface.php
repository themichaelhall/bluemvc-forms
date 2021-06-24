<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use BlueMvc\Core\Interfaces\RequestInterface;

/**
 * Interface for forms.
 *
 * @since 1.0.0
 */
interface FormInterface
{
    /**
     * Adds an element to the form.
     *
     * @since 1.0.0
     *
     * @param FormElementInterface $element The element.
     */
    public function addElement(FormElementInterface $element): void;

    /**
     * Adds an element group to the form.
     *
     * @since 2.2.0
     *
     * @param FormElementGroupInterface $elementGroup The element group.
     */
    public function addElementGroup(FormElementGroupInterface $elementGroup): void;

    /**
     * Returns the processed elements.
     *
     * @since 1.0.0
     *
     * @return array<FormElementInterface|FormElementGroupInterface> The processed elements.
     */
    public function getProcessedElements(): array;

    /**
     * Returns true if form has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if form has an error, false otherwise.
     */
    public function hasError(): bool;

    /**
     * Returns true if form is processed, false otherwise.
     *
     * @since 1.1.0
     *
     * @return bool True if form is processed, false otherwise.
     */
    public function isProcessed(): bool;

    /**
     * Processes the form.
     *
     * @since 1.0.0
     *
     * @param RequestInterface $request The request.
     *
     * @return bool True if form was successfully processed, false otherwise.
     */
    public function process(RequestInterface $request): bool;
}
