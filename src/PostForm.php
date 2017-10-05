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
use BlueMvc\Forms\Interfaces\SetFormValueElementInterface;
use BlueMvc\Forms\Interfaces\SetUploadedFileElementInterface;
use DataTypes\Url;

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

        // fixme: optionally disable this check
        if (!self::myIsValidOrigin($request)) {
            return false;
        }

        $elements = $this->myGetElementsToProcess();

        // Set form values for elements.
        foreach ($elements as $element) {
            if ($element instanceof SetFormValueElementInterface) {
                $formValue = $request->getFormParameter($element->getName()) ?: '';
                $element->setFormValue($formValue);
            }
            if ($element instanceof SetUploadedFileElementInterface) {
                $uploadedFile = $request->getUploadedFile($element->getName());
                $element->setUploadedFile($uploadedFile);
            }
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

        return $headerUrl->getHost()->__toString() === $request->getUrl()->getHost()->__toString();
    }
}
