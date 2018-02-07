<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractSetFormValueElement;
use BlueMvc\Forms\Interfaces\OptionInterface;
use BlueMvc\Forms\Interfaces\SelectInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;

/**
 * Class representing a select.
 *
 * @since 1.0.0
 */
class Select extends AbstractSetFormValueElement implements SelectInterface
{
    use BuildTagTrait;

    /**
     * Select constructor.
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
        $this->myOptions = [];
        $this->myHasEmptyOption = false;
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
        $option->setSelected($option->getValue() === $this->myValue);

        if ($option->getValue() === '') {
            $this->myHasEmptyOption = true;
        }

        $this->myOptions[] = $option;
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
            $optionsHtml .= $option->getHtml();
        }

        return self::myBuildTag('select', $optionsHtml,
            array_merge(
                [
                    'name'     => $this->getName(),
                    'required' => $this->isRequired() && $this->myHasEmptyOption,
                ],
                $attributes
            ), true
        );
    }

    /**
     * Returns the options.
     *
     * @since 1.0.0
     *
     * @return OptionInterface[] The options.
     */
    public function getOptions()
    {
        return $this->myOptions;
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
        foreach ($this->myOptions as $option) {
            $isMatch = ($value === $option->getValue());
            $option->setSelected($isMatch);

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
     * @var OptionInterface[] My options.
     */
    private $myOptions;

    /**
     * @var bool True if select has at least one empty option, false otherwise.
     */
    private $myHasEmptyOption;
}
