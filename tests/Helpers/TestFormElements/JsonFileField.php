<?php

namespace BlueMvc\Forms\Tests\Helpers\TestFormElements;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Forms\FileField;

/**
 * A file field that only accepts valid json content.
 */
class JsonFileField extends FileField
{
    /**
     * Constructs the json file field.
     *
     * @param string $name The name.
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->myJson = [];
    }

    /**
     * Returns the json content as an array.
     *
     * @return array The json content as an array.
     */
    public function getJson()
    {
        return $this->myJson;
    }

    /**
     * Called when uploaded file is set from form.
     *
     * @param UploadedFileInterface|null $uploadedFile The file from form.
     */
    protected function onSetUploadedFile(UploadedFileInterface $uploadedFile = null)
    {
        $this->myJson = [];

        parent::onSetUploadedFile($uploadedFile);

        if ($this->hasError()) {
            return;
        }

        if ($uploadedFile === null) {
            return;
        }

        $content = file_get_contents($uploadedFile->getPath()->__toString());
        $json = json_decode($content, true);

        if ($json === null) {
            $this->setError('Invalid json content.');

            return;
        }

        $this->myJson = $json;
    }

    /**
     * @var array My json content.
     */
    private $myJson;
}
