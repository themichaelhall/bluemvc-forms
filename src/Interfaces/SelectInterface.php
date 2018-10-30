<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms\Interfaces;

/**
 * Interface for Select class.
 *
 * @since 1.0.0
 */
interface SelectInterface extends SetFormValueElementInterface, \Countable
{
    /**
     * Adds on option.
     *
     * @since 1.0.0
     *
     * @param OptionInterface $option The option.
     */
    public function addOption(OptionInterface $option): void;

    /**
     * Returns the options.
     *
     * @since 1.0.0
     *
     * @return OptionInterface[] The options.
     */
    public function getOptions(): array;

    /**
     * Returns the element value.
     *
     * @since 1.0.0
     *
     * @return string The element value.
     */
    public function getValue(): string;
}
