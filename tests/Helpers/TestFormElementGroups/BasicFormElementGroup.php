<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests\Helpers\TestFormElementGroups;

use BlueMvc\Forms\CheckBox;
use BlueMvc\Forms\FormElementGroup;
use BlueMvc\Forms\Interfaces\CheckBoxInterface;
use BlueMvc\Forms\Interfaces\TextFieldInterface;
use BlueMvc\Forms\TextField;

/**
 * A basic form element group.
 */
class BasicFormElementGroup extends FormElementGroup
{
    /**
     * TestBasicFormElementGroup constructor.
     *
     * @param string $id              The base id of this form element group.
     * @param bool   $disableElements If true, disable all elements.
     */
    public function __construct(string $id, bool $disableElements = false)
    {
        $this->textField = new TextField($id . '-text');
        $this->textField->setDisabled($disableElements);

        $this->checkBox = new CheckBox($id . '-checkbox');
        $this->checkBox->setDisabled($disableElements);

        $this->privateTextField = new TextField($id . '-private-text');
        $this->privateTextField->setDisabled($disableElements);
    }

    /**
     * @return TextFieldInterface
     */
    public function getTextField(): TextFieldInterface
    {
        return $this->textField;
    }

    /**
     * @return CheckBoxInterface
     */
    public function getCheckBox(): CheckBoxInterface
    {
        return $this->checkBox;
    }

    /**
     * @return TextFieldInterface
     */
    public function getPrivateTextField(): TextFieldInterface
    {
        return $this->privateTextField;
    }

    /**
     * @var TextFieldInterface
     */
    protected TextFieldInterface $textField;

    /**
     * @var CheckBoxInterface
     */
    protected CheckBoxInterface $checkBox;

    /**
     * @var TextFieldInterface
     */
    private TextFieldInterface $privateTextField;
}
