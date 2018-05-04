<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

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
     * Sets the uploaded file from form.
     *
     * @since 1.0.0
     *
     * @param UploadedFileInterface|null $uploadedFile The uploaded file from form.
     */
    public function setUploadedFile(?UploadedFileInterface $uploadedFile = null): void
    {
        $this->onSetUploadedFile($uploadedFile);
    }

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
    ): void {
        if ($this->isEmpty() && $this->isRequired()) {
            $this->setError('Missing file');
        }
    }
}
