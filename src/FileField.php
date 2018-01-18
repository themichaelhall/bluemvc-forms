<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Forms\Base\AbstractSetUploadedFileElement;
use BlueMvc\Forms\Interfaces\FileFieldInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a file field.
 *
 * @since 1.0.0
 */
class FileField extends AbstractSetUploadedFileElement implements FileFieldInterface
{
    use BuildTagTrait;

    /**
     * Constructs the file field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->myFile = null;
    }

    /**
     * Returns the uploaded file or null if no uploaded file is present.
     *
     * @since 1.0.0
     *
     * @return UploadedFileInterface|null The uploaded file or null if no uploaded file is present.
     */
    public function getFile()
    {
        return $this->myFile;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = [])
    {
        return self::myBuildTag('input', null,
            array_merge(
                [
                    'type'     => 'file',
                    'name'     => $this->getName(),
                    'required' => $this->isRequired(),
                ],
                $attributes
            )
        );
    }

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty()
    {
        return $this->myFile === null;
    }

    /**
     * Called when uploaded file is set from form.
     *
     * @since 1.0.0
     *
     * @param UploadedFileInterface|null $uploadedFile The file from form.
     */
    protected function onSetUploadedFile(UploadedFileInterface $uploadedFile = null)
    {
        $this->myFile = $uploadedFile;

        parent::onSetUploadedFile();
    }

    /**
     * @var UploadedFileInterface|null My file.
     */
    private $myFile;
}
