<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Interfaces\OptionInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a select.
 *
 * @since 1.0.0
 */
class Select
{
    use BuildTagTrait;

    /**
     * Select constructor.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function __construct($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name parameter is not a string.');
        }

        $this->myName = $name;
        $this->myValue = '';
        $this->myOptions = [];
    }

    /**
     * Adds on option.
     *
     * @since 1.0.0
     *
     * @param OptionInterface $option The option.
     */
    public function addOption(OptionInterface $option)
    {
        $this->myOptions[$option->getValue()] = $option;
    }

    /**
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @param array $attributes The attributes.
     *
     * @return string The element html.
     */
    public function getHtml(array $attributes = [])
    {
        $optionsHtml = '';
        foreach ($this->myOptions as $option) {
            /** @var OptionInterface $option */
            $optionsHtml .= $option->getHtml(
                ['selected' => $option->getValue() === $this->myValue]
            );
        }

        return self::myBuildTag('select', $optionsHtml,
            array_merge(
                [
                    'name'     => $this->myName,
                    'required' => true,
                ],
                $attributes
            ), true
        );
    }

    /**
     * Returns the element name.
     *
     * @since 1.0.0
     *
     * @return string The element name.
     */
    public function getName()
    {
        return $this->myName;
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
     * Returns the element html.
     *
     * @since 1.0.0
     *
     * @return string The element html.
     */
    public function __toString()
    {
        return $this->getHtml();
    }

    /**
     * @var string My name.
     */
    private $myName;

    /**
     * @var string My value.
     */
    private $myValue;

    /**
     * @var array My options.
     */
    private $myOptions;
}
