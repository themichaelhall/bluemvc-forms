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
use Traversable;

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
     * Returns the number of radio buttons.
     *
     * @since 2.1.0
     *
     * @return int The number of radio buttons.
     */
    public function count(): int
    {
        return count($this->radioButtons);
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
        if ($this->isDisabled()) {
            $attributes['disabled'] = true;
        }

        $result = '';
        foreach ($this->radioButtons as $radioButton) {
            $result .= $radioButton->getHtml($attributes) . htmlspecialchars($radioButton->getLabel());
        }

        return $result;
    }

    /**
     * Returns the iterator for the radio buttons.
     *
     * @since 2.1.0
     *
     * @return Traversable The iterator.
     */
    public function getIterator(): Traversable
    {
        foreach ($this->radioButtons as $radioButton) {
            yield $radioButton->getValue() => $radioButton;
        }
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
     * Returns the selected radio button or null if no radio button is selected.
     *
     * @since 2.2.0
     *
     * @return RadioButtonInterface|null The selected radio button or null if no radio button is selected.
     */
    public function getSelectedRadioButton(): ?RadioButtonInterface
    {
        return $this->findRadioButtonWithValue($this->value);
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
        $newSelectedRadioButton = $this->findRadioButtonWithValue($value);
        if ($newSelectedRadioButton === null || $newSelectedRadioButton->isDisabled()) {
            return;
        }

        $this->value = $newSelectedRadioButton->getValue();

        foreach ($this->radioButtons as $radioButton) {
            $radioButtonIsSelected = $radioButton->getValue() === $this->value;
            $radioButton->setSelected($radioButtonIsSelected);
        }

        /** @noinspection PhpDeprecationInspection */
        parent::onSetFormValue($value);
    }

    /**
     * Returns the radio button with the specified value or null if no radio button was found.
     *
     * @param string $value The value.
     *
     * @return RadioButtonInterface|null The radio button with the specified value or null if no radio button was found.
     */
    private function findRadioButtonWithValue(string $value): ?RadioButtonInterface
    {
        foreach ($this->radioButtons as $radioButton) {
            if ($radioButton->getValue() === $value) {
                return $radioButton;
            }
        }

        return null;
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
