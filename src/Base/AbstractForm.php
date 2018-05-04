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
use BlueMvc\Forms\Interfaces\FormElementInterface;
use BlueMvc\Forms\Interfaces\FormInterface;
use BlueMvc\Forms\Interfaces\SetFormValueElementInterface;
use BlueMvc\Forms\Interfaces\SetUploadedFileElementInterface;

/**
 * Abstract class representing a form.
 *
 * @since 1.0.0
 */
abstract class AbstractForm implements FormInterface
{
    /**
     * Adds an element to the form.
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
     * Returns the processed elements.
     *
     * @since 1.0.0
     *
     * @return FormElementInterface[] The processed elements.
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

        $elements = $this->getElementsToProcess();

        // Set form values for elements.
        foreach ($elements as $element) {
            if ($element instanceof SetFormValueElementInterface) {
                $formValue = $parameters->get($element->getName());
                $element->setFormValue($formValue !== null ? $formValue : '');
            }

            if ($element instanceof SetUploadedFileElementInterface && $uploadedFiles !== null) {
                $uploadedFile = $uploadedFiles->get($element->getName());
                $element->setUploadedFile($uploadedFile);
            }

            $this->processedElements[] = $element;
        }

        $this->onValidate();

        // Check for errors.
        foreach ($elements as $element) {
            if ($element->hasError()) {
                $this->hasError = true;
                break;
            }
        }

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
     * Returns the elements to process.
     *
     * @return FormElementInterface[] The elements to process.
     */
    private function getElementsToProcess(): array
    {
        $result = [];

        foreach (get_object_vars($this) as $element) {
            if ($element instanceof FormElementInterface) {
                $result[] = $element;
            }
        }

        $result = array_merge($result, $this->extraElements);

        return $result;
    }

    /**
     * @var FormElementInterface[] My extra elements to process.
     */
    private $extraElements = [];

    /**
     * @var bool True if form has error, false otherwise.
     */
    private $hasError = false;

    /**
     * @var bool True if form is processed, false otherwise.
     */
    private $isProcessed = false;

    /**
     * @var FormElementInterface[] My processed elements.
     */
    private $processedElements = [];
}
