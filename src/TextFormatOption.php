<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

/**
 * Text formatting options.
 *
 * @since 1.0.0
 */
class TextFormatOption
{
    /**
     * No text formatting.
     *
     * @since 1.0.0
     */
    const NONE = 0;

    /**
     * Trim text.
     *
     * @since 1.0.0
     */
    const TRIM = 1;

    /**
     * Compacts adjacent whitespaces into one.
     *
     * @since 1.0.0
     */
    const COMPACT = 2;
}
