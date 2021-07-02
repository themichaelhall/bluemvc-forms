<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Base;

use BlueMvc\Forms\TextFormatOptions;

/**
 * Abstract class representing a text element.
 *
 * @since 1.0.0
 */
abstract class AbstractTextElement extends AbstractSetFormValueElement
{
    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty(): bool
    {
        return $this->text === '';
    }

    /**
     * Constructs the text element.
     *
     * @since 1.0.0
     *
     * @param string $name              The name.
     * @param string $value             The value to display in input field.
     * @param int    $textFormatOptions The text format options.
     */
    protected function __construct(string $name, string $value = '', int $textFormatOptions = TextFormatOptions::NONE)
    {
        parent::__construct($name);

        $this->textFormatOptions = $textFormatOptions;
        $value = $this->sanitizeText($value);
        $this->formatText($value);
        $this->text = $value;
    }

    /**
     * Returns the value to display in input field.
     *
     * @since 1.0.0
     *
     * @return string The value to display in input field.
     */
    protected function getText(): string
    {
        return $this->text;
    }

    /**
     * Returns true if this text element is multi-line, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if this text element is multi-line, false otherwise.
     */
    abstract protected function isMultiLine(): bool;

    /**
     * Called when text should be formatted.
     *
     * @since 1.0.0
     *
     * @param string $text The text.
     */
    protected function onFormatText(string &$text): void
    {
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue(string $value): void
    {
        $value = $this->sanitizeText($value);
        $this->formatText($value);
        $this->text = $value;

        /** @noinspection PhpDeprecationInspection */
        parent::onSetFormValue($value);

        $this->onSetText($value);
    }

    /**
     * Called when text is set from form.
     *
     * @since 1.0.0
     *
     * @param string $text The text from form.
     */
    protected function onSetText(string $text): void
    {
    }

    /**
     * Formats the text according to the text format options.
     *
     * @param string $text The text.
     */
    private function formatText(string &$text): void
    {
        $lines = preg_split("/\r\n|\n|\r/", $text);
        $result = [];

        $lastEmptyLinesCount = 0;
        $hasFoundNonEmptyLines = false;

        foreach ($lines as $line) {
            if (($this->textFormatOptions & TextFormatOptions::TRIM) !== 0) {
                $line = trim($line);
            }
            if (($this->textFormatOptions & TextFormatOptions::COMPACT) !== 0) {
                $line = preg_replace('/\s+/', ' ', $line);
            }

            if ($line === '') {
                if (($this->textFormatOptions & TextFormatOptions::COMPACT_LINES) !== 0 && $lastEmptyLinesCount > 0) {
                    continue;
                }
                if (($this->textFormatOptions & TextFormatOptions::TRIM_LINES) !== 0 && !$hasFoundNonEmptyLines) {
                    continue;
                }

                $lastEmptyLinesCount++;
            } else {
                $lastEmptyLinesCount = 0;
                $hasFoundNonEmptyLines = true;
            }

            $result[] = $line;
        }

        if (($this->textFormatOptions & TextFormatOptions::TRIM_LINES) !== 0 && $lastEmptyLinesCount > 0) {
            // Trim the last empty lines (we did not know until now that those were at the end).
            array_splice($result, -$lastEmptyLinesCount);
        }

        $text = implode("\r\n", $result);

        $this->onFormatText($text);
    }

    /**
     * Sanitizes the text.
     *
     * @param string $text The text.
     *
     * @return string The sanitized text.
     */
    private function sanitizeText(string $text): string
    {
        $text = preg_replace($this->isMultiLine() ? '/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/u' : '/[\x00-\x1F\x7F]/u', '', $text);
        if ($text === null) {
            return '';
        }

        return $text;
    }

    /**
     * @var int My text format options.
     */
    private $textFormatOptions;

    /**
     * @var string My text to display in input form.
     */
    private $text;
}
