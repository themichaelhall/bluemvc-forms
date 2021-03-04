<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

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
     * @param string      $name             The name.
     * @param string|null $content          The content or null if no content.
     * @param array       $attributes       The attributes.
     * @param bool        $contentIsEncoded If true, content is already encoded, false otherwise.
     *
     * @return string The tag.
     */
    private static function buildTag(string $name, ?string $content = null, array $attributes = [], bool $contentIsEncoded = false): string
    {
        $result = '<' . htmlspecialchars($name);
        foreach ($attributes as $attributeName => $attributeValue) {
            if ($attributeValue === null || $attributeValue === false) {
                continue;
            }

            $result .= ' ' . htmlspecialchars(strval($attributeName));
            if ($attributeValue === true) {
                continue;
            }

            $result .= '="' . htmlspecialchars(strval($attributeValue)) . '"';
        }

        $result .= '>';

        if ($content !== null) {
            $result .= $contentIsEncoded ? $content : htmlspecialchars($content);
            $result .= '</' . htmlspecialchars($name) . '>';
        }

        return $result;
    }
}
