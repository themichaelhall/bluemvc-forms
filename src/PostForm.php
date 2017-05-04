<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\RequestInterface;
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
     * @param RequestInterface $request The request.
     *
     * @return bool True if form was sucessfully processed, false otherwise.
     */
    public function process(RequestInterface $request)
    {
        return false;
    }
}
