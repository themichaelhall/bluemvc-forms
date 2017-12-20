<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractSetFormValueElement;
use BlueMvc\Forms\Interfaces\RadioButtonInterface;

/**
 * Class representing a collection of radio buttons.
 *
 * @since 1.0.0
 */
class RadioButtonCollection extends AbstractSetFormValueElement
{
    /**
     * RadioButtonCollection constructor.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param string $value The value.
     *
     * @throws \InvalidArgumentException If any of the $name or $value parameters is not a string.
     */
    public function __construct($name, $value = '')
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('$value parameter is not a string.');
        }

        parent::__construct($name);

        $this->myValue = $value;
        $this->myRadioButtons = [];
    }

    /**
     * Adds a radio button.
     *
     * @since 1.0.0
     *
     * @param RadioButtonInterface $radioButton The radio button.
     */
    public function addRadioButton(RadioButtonInterface $radioButton)
    {
        $radioButton->setName($this->getName());
        $radioButton->setSelected($radioButton->getValue() === $this->myValue);

        $this->myRadioButtons[] = $radioButton;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes which will be passed to each individual radio button.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = [])
    {
        $result = '';
        foreach ($this->myRadioButtons as $radioButton) {
            $result .= $radioButton->getHtml($attributes) . htmlspecialchars($radioButton->getLabel());
        }

        return $result;
    }

    /**
     * Returns the radio buttons.
     *
     * @since 1.0.0
     *
     * @return RadioButtonInterface[] The radio buttons.
     */
    public function getRadioButtons()
    {
        return $this->myRadioButtons;
    }

    /**
     * Returns the element value.
     *
     * @since 1.0.0
     *
     * @return string The element value.
     */
    public function getValue()
    {
        return $this->myValue;
    }

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty()
    {
        return $this->myValue === '';
    }

    /**
     * Called when value is set from form.
     *
     * @since 1.0.0
     *
     * @param string $value The value from form.
     */
    protected function onSetFormValue($value)
    {
        foreach ($this->myRadioButtons as $radioButton) {
            $isMatch = ($value === $radioButton->getValue());
            $radioButton->setSelected($isMatch);

            if ($isMatch) {
                $this->myValue = $value;
            }
        }

        parent::onSetFormValue($value);
    }

    /**
     * @var string My value.
     */
    private $myValue;

    /**
     * @var RadioButtonInterface[] My radio buttons.
     */
    private $myRadioButtons;
}
