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
 * Interface for FileField class.
 *
 * @since 1.0.0
 */
interface FileFieldInterface extends SetUploadedFileElementInterface
{
    /**
     * Returns the uploaded file or null if no uploaded file is present.
     *
     * @since 1.0.0
     *
     * @return UploadedFileInterface|null The uploaded file or null if no uploaded file is present.
     */
    public function getFile(): ?UploadedFileInterface;
}
