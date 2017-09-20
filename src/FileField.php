<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Forms\Base\AbstractFormElement;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a file field.
 *
 * @since 1.0.0
 */
class FileField extends AbstractFormElement
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

        $this->myValue = null;
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
     * Returns the uploaded file or null if no uploaded file is present.
     *
     * @since 1.0.0
     *
     * @return UploadedFileInterface|null The uploaded file or null if no uploaded file is present.
     */
    public function getValue()
    {
        return $this->myValue;
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
        return $this->myValue === null;
    }

    /**
     * @var UploadedFileInterface|null My value.
     */
    private $myValue;
}
