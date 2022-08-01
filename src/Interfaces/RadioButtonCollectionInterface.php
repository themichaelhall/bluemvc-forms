<?php

/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

use Countable;
use IteratorAggregate;

/**
 * Interface for RadioButtonCollection class.
 *
 * @since 1.0.0
 *
 * @extends IteratorAggregate<string, RadioButtonInterface>
 */
interface RadioButtonCollectionInterface extends SetFormValueElementInterface, Countable, IteratorAggregate
{
    /**
     * Adds a radio button.
     *
     * @since 1.0.0
     *
     * @param RadioButtonInterface $radioButton The radio button.
     */
    public function addRadioButton(RadioButtonInterface $radioButton): void;

    /**
     * Returns the radio buttons.
     *
     * @since 1.0.0
     *
     * @return RadioButtonInterface[] The radio buttons.
     */
    public function getRadioButtons(): array;

    /**
     * Returns the selected radio button or null if no radio button is selected.
     *
     * @since 2.2.0
     *
     * @return RadioButtonInterface|null The selected radio button or null if no radio button is selected.
     */
    public function getSelectedRadioButton(): ?RadioButtonInterface;

    /**
     * Returns the element value.
     *
     * @since 1.0.0
     *
     * @return string The element value.
     */
    public function getValue(): string;
}
