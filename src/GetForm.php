<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\RequestInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;
use BlueMvc\Forms\Interfaces\GetFormInterface;
use BlueMvc\Forms\Interfaces\SetFormValueElementInterface;

/**
 * Class representing a get form.
 *
 * @since 1.0.0
 */
abstract class GetForm implements GetFormInterface
{
    /**
     * Adds an element to the form.
     *
     * @since 1.0.0
     *
     * @param FormElementInterface $element The element.
     */
    public function addElement(FormElementInterface $element)
    {
        $this->myExtraElements[] = $element;
    }

    /**
     * Returns the processed elements.
     *
     * @since 1.0.0
     *
     * @return FormElementInterface[] The processed elements.
     */
    public function getProcessedElements()
    {
        return $this->myProcessedElements;
    }

    /**
     * Returns true if form has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if form has an error, false otherwise.
     */
    public function hasError()
    {
        return $this->myHasError;
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
    public function process(RequestInterface $request)
    {
        $this->myHasError = false;
        $this->myProcessedElements = [];

        if (!$request->getMethod()->isGet()) {
            return false;
        }

        $elements = $this->myGetElementsToProcess();

        // Set form values for elements.
        foreach ($elements as $element) {
            if ($element instanceof SetFormValueElementInterface) {
                $formValue = $request->getQueryParameter($element->getName());
                $element->setFormValue($formValue !== null ? $formValue : '');
            }

            $this->myProcessedElements[] = $element;
        }

        $this->onValidate();

        // Check for errors.
        foreach ($elements as $element) {
            if ($element->hasError()) {
                $this->myHasError = true;
                break;
            }
        }

        if (!$this->myHasError) {
            $this->onSuccess();
        } else {
            $this->onError();
        }

        $this->onProcessed();

        return !$this->myHasError;
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

        $result = array_merge($result, $this->myExtraElements);

        return $result;
    }

    /**
     * @var FormElementInterface[] My extra elements to process.
     */
    private $myExtraElements = [];

    /**
     * @var bool True if form has error, false otherwise.
     */
    private $myHasError = false;

    /**
     * @var FormElementInterface[] My processed elements.
     */
    private $myProcessedElements = [];
}
