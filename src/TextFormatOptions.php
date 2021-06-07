<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms;

/**
 * Text formatting options.
 *
 * @since 1.0.0
 */
class TextFormatOptions
{
    /**
     * No text formatting.
     *
     * @since 1.0.0
     */
    public const NONE = 0;

    /**
     * Trim text.
     *
     * @since 1.0.0
     */
    public const TRIM = 1;

    /**
     * Compacts adjacent whitespaces into one.
     *
     * @since 1.0.0
     */
    public const COMPACT = 2;

    /**
     * Removes empty lines from start and end.
     *
     * @since 1.0.0
     */
    public const TRIM_LINES = 4;

    /**
     * Compact adjacent empty lines into one.
     *
     * @since 1.0.0
     */
    public const COMPACT_LINES = 8;
}
