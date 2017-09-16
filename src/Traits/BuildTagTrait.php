<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Traits;

/**
 * Trait for building a tag.
 *
 * @since 1.0.0
 */
trait BuildTagTrait
{
    /**
     * Builds a tag from a name and attributes array.
     *
     * @param string      $name       The name.
     * @param string|null $content    The content or null if no content.
     * @param array       $attributes The attributes.
     *
     * @return string The tag.
     */
    private static function myBuildTag($name, $content = null, $attributes = [])
    {
        $result = '<' . htmlspecialchars($name);
        foreach ($attributes as $attributeName => $attributeValue) {
            if ($attributeValue === null || $attributeValue === false || $attributeValue === '') {
                continue;
            }

            $result .= ' ' . htmlspecialchars($attributeName);
            if ($attributeValue === true) {
                continue;
            }

            $result .= '="' . htmlspecialchars($attributeValue) . '"';
        }

        $result .= '>';

        if ($content !== null) {
            $result .= htmlspecialchars($content) . '</' . htmlspecialchars($name) . '>';
        }

        return $result;
    }
}
