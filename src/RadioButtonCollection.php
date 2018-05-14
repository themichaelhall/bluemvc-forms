<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractSetFormValueElement;
use BlueMvc\Forms\Interfaces\RadioButtonCollectionInterface;
use BlueMvc\Forms\Interfaces\RadioButtonInterface;

/**
 * Class representing a collection of radio buttons.
 *
 * @since 1.0.0
 */
class RadioButtonCollection extends AbstractSetFormValueElement implements RadioButtonCollectionInterface
{
    /**
     * RadioButtonCollection constructor.
     *
     * @since 1.0.0
     *
     * @param string $name  The name.
     * @param string $value The value.
     */
    public function __construct(string $name, string $value = '')
    {
        parent::__construct($name);

        $this->value = $value;
        $this->radioButtons = [];
    }

    /**
     * Adds a radio button.
     *
     * @since 1.0.0
     *
     * @param RadioButtonInterface $radioButton The radio button.
     */
    public function addRadioButton(RadioButtonInterface $radioButton): void
    {
        $radioButton->setName($this->getName());
        $radioButton->setSelected($radioButton->getValue() === $this->value);

        $this->radioButtons[] = $radioButton;
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
    public function getHtml(array $attributes = []): string
    {
        $result = '';
        foreach ($this->radioButtons as $radioButton) {
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
    public function getRadioButtons(): array
    {
        return $this->radioButtons;
    }

    /**
     * Returns the element value.
     *
     * @since 1.0.0
     *
     * @return string The element value.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Returns true if element value is empty, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if element value is empty, false otherwise.
     */
    public function isEmpty(): bool
    {
        return $this->value === '';
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
        foreach ($this->radioButtons as $radioButton) {
            $isMatch = ($value === $radioButton->getValue());
            $radioButton->setSelected($isMatch);

            if ($isMatch) {
                $this->value = $value;
            }
        }

        parent::onSetFormValue($value);
    }

    /**
     * @var string My value.
     */
    private $value;

    /**
     * @var RadioButtonInterface[] My radio buttons.
     */
    private $radioButtons;
}
