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
class TestBasicFormElementGroup extends FormElementGroup
{
    /**
     * TestBasicFormElementGroup constructor.
     */
    public function __construct(string $id)
    {
        parent::__construct();

        $this->textField = new TextField($id . '-text');
        $this->checkBox = new CheckBox($id . '-checkbox');
        $this->privateTextField = new TextField($id . '-private-text');
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
    protected $textField;

    /**
     * @var CheckBoxInterface
     */
    protected $checkBox;

    /**
     * @var TextFieldInterface
     */
    private $privateTextField;
}
