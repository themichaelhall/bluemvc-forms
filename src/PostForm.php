<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\RequestInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;
use BlueMvc\Forms\Interfaces\FormInterface;

/**
 * Class representing a post form.
 *
 * @since 1.0.0
 */
abstract class PostForm implements FormInterface
{
    /**
     * Processes the form.
     *
     * @since 1.0.0
     *
     * @param RequestInterface $request The request.
     *
     * @return bool True if form was successfully processed, false otherwise.
     */
    public function process(RequestInterface $request)
    {
        if (!$request->getMethod()->isPost()) {
            return false;
        }

        $elements = $this->myGetElementsToProcess();

        // Set form values for elements.
        foreach ($elements as $element) {
            $formValue = $request->getFormParameter($element->getName()) ?: '';
            $element->setFormValue($formValue);
        }

        // Validate elements.
        foreach ($elements as $element) {
            if ($element->isRequired() && $element->isEmpty()) {
                $element->setError('Value is required.');
            } elseif (!$element->isValid()) {
                $element->setError('Value is invalid.');
            }

            $element->onValidate();
        }

        $this->onValidate();

        // Check for errors.
        $hasError = false;
        foreach ($elements as $element) {
            if ($element->hasError()) {
                $hasError = true;
                break;
            }
        }

        if (!$hasError) {
            $this->onSuccess();
        } else {
            $this->onError();
        }

        $this->onProcessed();

        return !$hasError;
    }

    /**
     * Called when form elements should be validated.
     *
     * @since 1.0.0
     */
    protected function onValidate()
    {
    }

    /**
     * Called if form processing was successful.
     *
     * @since 1.0.0
     */
    protected function onSuccess()
    {
    }

    /**
     * Called if form processing was not successful.
     *
     * @since 1.0.0
     */
    protected function onError()
    {
    }

    /**
     * Called when form processing finishes, regardless if processing was successful or not.
     *
     * @since 1.0.0
     */
    protected function onProcessed()
    {
    }

    /**
     * Returns the elements to process.
     *
     * @return FormElementInterface[] The elements to process.
     */
    private function myGetElementsToProcess()
    {
        $result = [];

        foreach (get_object_vars($this) as $element) {
            if ($element instanceof FormElementInterface) {
                $result[] = $element;
            }
        }

        return $result;
    }
}
