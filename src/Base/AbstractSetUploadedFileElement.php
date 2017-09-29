<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Base;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Forms\Interfaces\SetUploadedFileElementInterface;

/**
 * Abstract class representing an element that handles an uploaded file.
 *
 * @since 1.0.0
 */
abstract class AbstractSetUploadedFileElement extends AbstractFormElement implements SetUploadedFileElementInterface
{
    /**
     * Called when uploaded file is set from form.
     *
     * @since 1.0.0
     *
     * @param UploadedFileInterface|null $uploadedFile The file from form.
     */
    protected function onSetUploadedFile(
        /** @noinspection PhpUnusedParameterInspection */
        UploadedFileInterface $uploadedFile = null
    ) {
        if ($this->isEmpty() && $this->isRequired()) {
            $this->setError('Missing file');
        }
    }
}
