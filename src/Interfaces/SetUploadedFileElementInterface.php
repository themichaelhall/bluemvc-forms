<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use BlueMvc\Core\Interfaces\UploadedFileInterface;

/**
 * Interface for elements that handles an uploaded file.
 *
 * @since 1.0.0
 */
interface SetUploadedFileElementInterface extends FormElementInterface
{
    /**
     * Sets the uploaded file from form.
     *
     * @since 1.0.0
     *
     * @param UploadedFileInterface|null $uploadedFile The uploaded file from form.
     */
    public function setUploadedFile(?UploadedFileInterface $uploadedFile = null): void;
}
