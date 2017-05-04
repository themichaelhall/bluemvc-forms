<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

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
     * Processes the form.
     *
     * @since 1.0.0
     *
     * @param RequestInterface $request The request.
     *
     * @return bool True if form was sucessfully processed, false otherwise.
     */
    public function process(RequestInterface $request);
}
