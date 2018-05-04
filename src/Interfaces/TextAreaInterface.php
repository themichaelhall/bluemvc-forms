<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for TextArea class.
 *
 * @since 1.0.0
 */
interface TextAreaInterface extends SetFormValueElementInterface
{
    /**
     * Returns the value of the text area.
     *
     * @since 1.0.0
     *
     * @return string The value of the text area.
     */
    public function getValue(): string;
}
