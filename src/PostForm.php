<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\RequestInterface;
use BlueMvc\Forms\Base\AbstractForm;
use BlueMvc\Forms\Interfaces\PostFormInterface;
use DataTypes\Url;

/**
 * Class representing a post form.
 *
 * @since 1.0.0
 */
abstract class PostForm extends AbstractForm implements PostFormInterface
{
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
        if (!$request->getMethod()->isPost()) {
            return false;
        }

        if ($this->myCheckOriginEnabled && !self::myIsValidOrigin($request)) {
            return false;
        }

        return $this->doProcess($request->getFormParameters(), $request->getUploadedFiles());
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
}
