<?php
/**
 * This file is a part of the bluemvc-forms package.
 *
 * Read more at https://bluemvc.com/
 */
declare(strict_types=1);

namespace BlueMvc\Forms;

use BlueMvc\Forms\Base\AbstractSetFormValueElement;
use BlueMvc\Forms\Interfaces\OptionInterface;
use BlueMvc\Forms\Interfaces\SelectInterface;
use BlueMvc\Forms\Traits\BuildTagTrait;
use Traversable;

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
     */
    public function __construct(string $name, string $value = '')
    {
        parent::__construct($name);

        $this->value = $value;
        $this->options = [];
        $this->hasEmptyOption = false;
    }

    /**
     * Adds on option.
     *
     * @since 1.0.0
     *
     * @param OptionInterface $option The option.
     */
    public function addOption(OptionInterface $option): void
    {
        $option->setSelected($option->getValue() === $this->value);

        if ($option->getValue() === '') {
            $this->hasEmptyOption = true;
        }

        $this->options[] = $option;
    }

    /**
     * Returns the number of options.
     *
     * @since 2.1.0
     *
     * @return int The number of options.
     */
    public function count(): int
    {
        return count($this->options);
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
    public function getHtml(array $attributes = []): string
    {
        $optionsHtml = '';
        foreach ($this->options as $option) {
            $optionsHtml .= $option->getHtml();
        }

        return self::buildTag('select', $optionsHtml,
            array_merge(
                [
                    'name'     => $this->getName(),
                    'required' => $this->isRequired() && $this->hasEmptyOption,
                ],
                $attributes
            ), true
        );
    }

    /**
     * Returns the iterator for select.
     *
     * @since 2.1.0
     *
     * @return Traversable The iterator.
     */
    public function getIterator(): Traversable
    {
        foreach ($this->options as $option) {
            yield $option->getValue() => $option;
        }
    }

    /**
     * Returns the options.
     *
     * @since 1.0.0
     *
     * @return OptionInterface[] The options.
     */
    public function getOptions(): array
    {
        return $this->options;
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
        foreach ($this->options as $option) {
            $isMatch = ($value === $option->getValue());
            $option->setSelected($isMatch);

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
     * @var OptionInterface[] My options.
     */
    private $options;

    /**
     * @var bool True if select has at least one empty option, false otherwise.
     */
    private $hasEmptyOption;
}
