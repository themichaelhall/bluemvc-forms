<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

/**
 * Class representing a text field.
 *
 * @since 1.0.0
 */
class TextField
{
    /**
     * Constructs the text field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     */
    public function __construct($name)
    {
        $this->myId = 'form-' . $name;
        $this->myName = $name;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @return string The element html.
     */
    public function getElementHtml()
    {
        return '<input type="text" id="' . htmlspecialchars($this->myId) . '" name="' . htmlspecialchars($this->myName) . '">';
    }

    /**
     * @var string My id.
     */
    private $myId;

    /**
     * @var string My name.
     */
    private $myName;
}
