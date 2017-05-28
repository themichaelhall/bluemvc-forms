<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for form elements.
 *
 * @since 1.0.0
 */
interface FormElementInterface
{
    /**
     * Returns the element error or null if element has no error.
     *
     * @since 1.0.0
     *
     * @return string|null The element error or null if element has no error.
     */
    public function getError();

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = []);

    /**
     * Returns the element name.
     *
     * @since 1.0.0
     *
     * @return string The element name.
     */
    public function getName();

    /**
     * Returns true if element has an error, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element has an error, false otherwise.
     */
    public function hasError();

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty();

    /**
     * Returns true if element value is required, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is required, false otherwise.
     */
    public function isRequired();

    /**
     * Returns true if element value is valid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is valid, false otherwise.
     */
    public function isValid();

    /**
     * Called when form element should be validated.
     *
     * @since 1.0.0
     */
    public function onValidate();

    /**
     * Sets the element error.
     *
     * @since 1.0.0
     *
     * @param string $error The element error.
     */
    public function setError($error);

    /**
     * Sets the value from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    public function setFormValue($value);
}
