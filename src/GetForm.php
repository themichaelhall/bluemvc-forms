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
use BlueMvc\Forms\Interfaces\GetFormInterface;

/**
 * Class representing a get form.
 *
 * @since 1.0.0
 */
abstract class GetForm extends AbstractForm implements GetFormInterface
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
    public function process(RequestInterface $request): bool
    {
        if (!$request->getMethod()->isGet()) {
            return false;
        }

        if ($request->getUrl()->getQueryString() === null) {
            return false;
        }

        return $this->doProcess($request->getQueryParameters());
    }
}
