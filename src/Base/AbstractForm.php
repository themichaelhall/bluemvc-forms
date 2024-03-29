<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Base;

use BlueMvc\Core\Interfaces\Collections\ParameterCollectionInterface;
use BlueMvc\Core\Interfaces\Collections\UploadedFileCollectionInterface;
use BlueMvc\Core\Interfaces\RequestInterface;
use BlueMvc\Forms\Interfaces\FormElementGroupInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;
use BlueMvc\Forms\Interfaces\FormInterface;
use BlueMvc\Forms\Interfaces\SetFormValueElementInterface;
use BlueMvc\Forms\Interfaces\SetUploadedFileElementInterface;
use BlueMvc\Forms\Traits\FindContainedFormElementsTrait;

/**
 * Abstract class representing a form.
 *
 * @since 1.0.0
 */
abstract class AbstractForm implements FormInterface
{
    use FindContainedFormElementsTrait;

    /**
     * Returns the processed elements.
     *
     * @since 1.0.0
     *
     * @return array<FormElementInterface|FormElementGroupInterface> The processed elements.
     */
    public function getProcessedElements(): array
    {
        return $this->processedElements;
    }

    /**
     * Returns true if form has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if form has an error, false otherwise.
     */
    public function hasError(): bool
    {
        return $this->hasError;
    }

    /**
     * Returns true if form is processed, false otherwise.
     *
     * @since 1.1.0
     *
     * @return bool True if form is processed, false otherwise.
     */
    public function isProcessed(): bool
    {
        return $this->isProcessed;
    }

    /**
     * Processes the form.
     *
     * @since 1.0.0
     *
     * @param RequestInterface $request The request.
     *
     * @return bool True if form was successfully processed, false otherwise.
     */
    abstract public function process(RequestInterface $request): bool;

    /**
     * Processes the form.
     *
     * @since 1.0.0
     *
     * @param ParameterCollectionInterface         $parameters    The parameters to process.
     * @param UploadedFileCollectionInterface|null $uploadedFiles The uploaded files to process or null if no uploaded files.
     *
     * @return bool True if form was successfully processed, false otherwise.
     */
    protected function doProcess(ParameterCollectionInterface $parameters, ?UploadedFileCollectionInterface $uploadedFiles = null): bool
    {
        $this->hasError = false;
        $this->processedElements = [];

        $elements = $this->findContainedElements();
        $this->setValuesForElements($elements, $parameters, $uploadedFiles);

        $this->onValidate();

        $this->checkElementsForError($elements);

        if (!$this->hasError) {
            $this->onSuccess();
        } else {
            $this->onError();
        }

        $this->onProcessed();
        $this->isProcessed = true;

        return !$this->hasError;
    }

    /**
     * Called when form elements should be validated.
     *
     * @since 1.0.0
     */
    protected function onValidate(): void
    {
    }

    /**
     * Called if form processing was successful.
     *
     * @since 1.0.0
     */
    protected function onSuccess(): void
    {
    }

    /**
     * Called if form processing was not successful.
     *
     * @since 1.0.0
     */
    protected function onError(): void
    {
    }

    /**
     * Called when form processing finishes, regardless if processing was successful or not.
     *
     * @since 1.0.0
     */
    protected function onProcessed(): void
    {
    }

    /**
     * Sets the form values for an array of form elements.
     *
     * @param array<FormElementInterface|FormElementGroupInterface> $elements      The form elements.
     * @param ParameterCollectionInterface                          $parameters    The form parameters.
     * @param UploadedFileCollectionInterface|null                  $uploadedFiles The uploaded files or null if no files were uploaded.
     */
    private function setValuesForElements(array $elements, ParameterCollectionInterface $parameters, ?UploadedFileCollectionInterface $uploadedFiles): void
    {
        foreach ($elements as $element) {
            $this->processedElements[] = $element;

            if ($element instanceof SetFormValueElementInterface) {
                $formValue = $parameters->get($element->getName());
                $element->setFormValue($formValue !== null ? $formValue : '');
            }

            if ($element instanceof SetUploadedFileElementInterface && $uploadedFiles !== null) {
                $uploadedFile = $uploadedFiles->get($element->getName());
                $element->setUploadedFile($uploadedFile);
            }

            if ($element instanceof FormElementGroupInterface) {
                $this->setValuesForElements($element->getElements(), $parameters, $uploadedFiles);
            }
        }
    }

    /**
     * Checks an array of form elements for errors. Returns on first error found.
     *
     * @param array<FormElementInterface|FormElementGroupInterface> $elements
     */
    private function checkElementsForError(array $elements): void
    {
        foreach ($elements as $element) {
            if ($element->hasError()) {
                $this->hasError = true;
                break;
            }

            if ($element instanceof FormElementGroupInterface) {
                $this->checkElementsForError($element->getElements());
            }
        }
    }

    /**
     * @var bool True if form has error, false otherwise.
     */
    private bool $hasError = false;

    /**
     * @var bool True if form is processed, false otherwise.
     */
    private bool $isProcessed = false;

    /**
     * @var array<FormElementInterface|FormElementGroupInterface> The processed elements.
     */
    private array $processedElements = [];
}
