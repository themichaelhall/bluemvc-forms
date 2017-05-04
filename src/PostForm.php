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
     * @return bool True if form was sucessfully processed, false otherwise.
     */
    public function process(RequestInterface $request)
    {
        if (!$request->getMethod()->isPost()) {
            return false;
        }

        foreach (get_object_vars($this) as $element) {
            if ($element instanceof FormElementInterface) {
                $formValue = $request->getFormParameter($element->getName());
                $element->setFormValue($formValue);
            }
        }

        return true;
    }
}
