<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\RequestInterface;
use BlueMvc\Forms\Interfaces\FormElementInterface;
use BlueMvc\Forms\Interfaces\PostFormInterface;
use BlueMvc\Forms\Interfaces\SetFormValueElementInterface;
use BlueMvc\Forms\Interfaces\SetUploadedFileElementInterface;
use DataTypes\Url;

/**
 * Class representing a post form.
 *
 * @since 1.0.0
 */
abstract class PostForm implements PostFormInterface
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
     * Returns true if check origin is enabled, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if check origin is enabled, false otherwise.
     */
    public function isCheckOriginEnabled()
    {
        return $this->myCheckOriginEnabled;
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

        if (!$request->getMethod()->isPost()) {
            return false;
        }

        if ($this->myCheckOriginEnabled && !self::myIsValidOrigin($request)) {
            return false;
        }

        $elements = $this->myGetElementsToProcess();

        // Set form values for elements.
        foreach ($elements as $element) {
            if ($element instanceof SetFormValueElementInterface) {
                $formValue = $request->getFormParameter($element->getName());
                $element->setFormValue($formValue !== null ? $formValue : '');
            }
            if ($element instanceof SetUploadedFileElementInterface) {
                $uploadedFile = $request->getUploadedFile($element->getName());
                $element->setUploadedFile($uploadedFile);
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
     * Sets whether check origin is enabled.
     *
     * @since 1.0.0
     *
     * @param bool $checkOriginEnabled True if check origin is enabled, false otherwise.
     *
     * @throws \InvalidArgumentException If the $checkOriginEnabled parameter is not a boolean.
     */
    public function setCheckOriginEnabled($checkOriginEnabled)
    {
        if (!is_bool($checkOriginEnabled)) {
            throw new \InvalidArgumentException('$checkOriginEnabled parameter is not a boolean.');
        }

        $this->myCheckOriginEnabled = $checkOriginEnabled;
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
     * Checks if the request has valid origin headers present.
     *
     * @param RequestInterface $request The request.
     *
     * @return bool True if request has valid origin headers present, false otherwise.
     */
    private static function myIsValidOrigin(RequestInterface $request)
    {
        if (!self::myCompareHeaderUrl($request, 'Origin')) {
            return false;
        }

        if (!self::myCompareHeaderUrl($request, 'Referer')) {
            return false;
        }

        return true;
    }

    /**
     * Compares a header url with the url in the request.
     *
     * @param RequestInterface $request    The request.
     * @param string           $headerName The header name.
     *
     * @return bool True if the header url and request url has the same host, false otherwise.
     */
    private static function myCompareHeaderUrl(RequestInterface $request, $headerName)
    {
        $headerValue = $request->getHeader($headerName);
        if ($headerValue === null) {
            // Header value not present.
            return true;
        }

        $headerUrl = Url::tryParse($headerValue);
        if ($headerUrl === null) {
            // Header value is not a valid url.
            return false;
        }

        return $headerUrl->getHost()->equals($request->getUrl()->getHost());
    }

    /**
     * @var bool True if check origin is enabled, false otherwise.
     */
    private $myCheckOriginEnabled = true;

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
