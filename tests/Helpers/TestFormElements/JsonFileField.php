<?php

declare(strict_types=1);

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
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->json = [];
    }

    /**
     * Returns the json content as an array.
     *
     * @return array The json content as an array.
     */
    public function getJson(): array
    {
        return $this->json;
    }

    /**
     * Called when uploaded file is set from form.
     *
     * @param UploadedFileInterface|null $uploadedFile The file from form.
     */
    protected function onSetUploadedFile(?UploadedFileInterface $uploadedFile = null): void
    {
        $this->json = [];

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

        $this->json = $json;
    }

    /**
     * @var array My json content.
     */
    private $json;
}
