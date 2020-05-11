<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractTextElement;
use BlueMvc\Forms\Interfaces\TextAreaInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a text area.
 *
 * @since 1.0.0
 */
class TextArea extends AbstractTextElement implements TextAreaInterface
{
    use BuildTagTrait;

    /**
     * Constructs the text area.
     *
     * @since 1.0.0
     *
     * @param string $name              The name.
     * @param string $value             The value.
     * @param int    $textFormatOptions The text format options.
     */
    public function __construct(string $name, string $value = '', $textFormatOptions = TextFormatOptions::TRIM | TextFormatOptions::COMPACT | TextFormatOptions::TRIM_LINES | TextFormatOptions::COMPACT_LINES)
    {
        parent::__construct($name, $value, $textFormatOptions);
    }

    /**
     * Returns the value of the text area.
     *
     * @since 1.0.0
     *
     * @return string The value of the text area.
     */
    public function getValue(): string
    {
        return $this->getText();
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
    public function getHtml(array $attributes = []): string
    {
        return self::buildTag('textarea', $this->getText(),
            array_merge(
                [
                    'name'     => $this->getName(),
                    'required' => $this->isRequired(),
                    'disabled' => $this->isDisabled(),
                ],
                $attributes
            )
        );
    }

    /**
     * Returns true if this text element is multi-line, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if this text element is multi-line, false otherwise.
     */
    protected function isMultiLine(): bool
    {
        return true;
    }
}
