<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for RadioButtonCollection class.
 *
 * @since 1.0.0
 */
interface RadioButtonCollectionInterface extends SetFormValueElementInterface, \Countable, \IteratorAggregate
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
     * Returns the element value.
     *
     * @since 1.0.0
     *
     * @return string The element value.
     */
    public function getValue(): string;
}
