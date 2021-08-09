<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests\Helpers\TestFormElementGroups;

use BlueMvc\Forms\FormElementGroup;
use BlueMvc\Forms\Interfaces\TextFieldInterface;
use BlueMvc\Forms\Interfaces\UrlFieldInterface;
use BlueMvc\Forms\TextField;
use BlueMvc\Forms\UrlField;

/**
 * An "outer" form element group, containing another form element groups.
 */
class OuterFormElementGroup extends FormElementGroup
{
    /**
     * OuterFormElementGroup constructor.
     *
     * @param string $id              The base id of this form element group.
     * @param string $innerId         The base id of the inner form element group.
     * @param bool   $disableElements If true, disable all elements.
     */
    public function __construct(string $id, string $innerId, bool $disableElements = false)
    {
        $this->textField1 = new TextField($id . '-text-1');
        $this->textField1->setDisabled($disableElements);

        $this->textField2 = new TextField($id . '-text-2');
        $this->textField2->setDisabled($disableElements);
        $this->addElement($this->textField2);

        $this->formElementGroup1 = new BasicFormElementGroup($innerId . '-1', $disableElements);
        $this->formElementGroup2 = new BasicFormElementGroup($innerId . '-2', $disableElements);
        $this->addElementGroup($this->formElementGroup2);

        $this->privateUrlField = new UrlField($id . '-url-1');
        $this->privateUrlField->setDisabled($disableElements);

        $this->privateFormElementGroup = new BasicFormElementGroup($innerId . '-3', $disableElements);
    }

    /**
     * @return TextFieldInterface
     */
    public function getTextField1(): TextFieldInterface
    {
        return $this->textField1;
    }

    /**
     * @return TextFieldInterface
     */
    public function getTextField2(): TextFieldInterface
    {
        return $this->textField2;
    }

    /**
     * @return BasicFormElementGroup
     */
    public function getFormElementGroup1(): BasicFormElementGroup
    {
        return $this->formElementGroup1;
    }

    /**
     * @return BasicFormElementGroup
     */
    public function getFormElementGroup2(): BasicFormElementGroup
    {
        return $this->formElementGroup2;
    }

    /**
     * @return UrlFieldInterface
     */
    public function getPrivateUrlField(): UrlFieldInterface
    {
        return $this->privateUrlField;
    }

    /**
     * @return BasicFormElementGroup
     */
    public function getPrivateFormElementGroup(): BasicFormElementGroup
    {
        return $this->privateFormElementGroup;
    }

    /**
     * @var TextFieldInterface
     */
    protected $textField1;

    /**
     * @var BasicFormElementGroup
     */
    protected $formElementGroup1;

    /**
     * @var TextFieldInterface
     */
    private $textField2;

    /**
     * @var BasicFormElementGroup
     */
    private $formElementGroup2;

    /**
     * @var UrlFieldInterface
     */
    private $privateUrlField;

    /**
     * @var BasicFormElementGroup
     */
    private $privateFormElementGroup;
}
