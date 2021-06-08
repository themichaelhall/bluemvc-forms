<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\RequestInterface;
use BlueMvc\Forms\Base\AbstractForm;
use BlueMvc\Forms\Interfaces\PostFormInterface;
use DataTypes\Net\Url;

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
    public function isCheckOriginEnabled(): bool
    {
        return $this->checkOriginEnabled;
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
    public function process(RequestInterface $request): bool
    {
        if (!$request->getMethod()->isPost()) {
            return false;
        }

        if ($this->checkOriginEnabled && !self::isValidOrigin($request)) {
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
     */
    public function setCheckOriginEnabled(bool $checkOriginEnabled): void
    {
        $this->checkOriginEnabled = $checkOriginEnabled;
    }

    /**
     * Checks if the request has valid origin headers present.
     *
     * @param RequestInterface $request The request.
     *
     * @return bool True if request has valid origin headers present, false otherwise.
     */
    private static function isValidOrigin(RequestInterface $request): bool
    {
        if (!self::compareHeaderUrl($request, 'Origin')) {
            return false;
        }

        if (!self::compareHeaderUrl($request, 'Referer')) {
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
    private static function compareHeaderUrl(RequestInterface $request, string $headerName): bool
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
    private $checkOriginEnabled = true;
}
