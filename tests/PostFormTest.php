<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\BasicTestPostForm;

/**
 * Test PostForm class.
 */
class PostFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test process with get request.
     */
    public function testProcessWithGetRequest()
    {
        $request = new FakeRequest('/', 'GET');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);

        self::assertSame('', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('', $this->form->getTextField()->getValue());
        self::assertFalse($this->form->getTextField()->hasError());

        self::assertSame('', $this->form->getPasswordField()->getValue());
        self::assertFalse($this->form->getPasswordField()->hasError());

        self::assertSame('', $this->form->getNameField()->getValue());
        self::assertFalse($this->form->getNameField()->hasError());
    }

    /**
     * Test process with post request.
     */
    public function testProcessWithPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('not-required', 'My not required value');
        $request->setFormParameter('text', 'My text value');
        $request->setFormParameter('password', 'My password');
        $request->setFormParameter('name', 'My name');

        $isProcessed = $this->form->process($request);

        self::assertTrue($isProcessed);

        self::assertSame('My not required value', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('My text value', $this->form->getTextField()->getValue());
        self::assertFalse($this->form->getTextField()->hasError());

        self::assertSame('My password', $this->form->getPasswordField()->getValue());
        self::assertFalse($this->form->getPasswordField()->hasError());

        self::assertSame('My Name', $this->form->getNameField()->getValue());
        self::assertFalse($this->form->getNameField()->hasError());
    }

    /**
     * Test process with empty post request.
     */
    public function testProcessWithEmptyPostRequest()
    {
        $request = new FakeRequest('/', 'POST');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);

        self::assertSame('', $this->form->getNotRequiredField()->getValue());
        self::assertFalse($this->form->getNotRequiredField()->hasError());

        self::assertSame('', $this->form->getTextField()->getValue());
        self::assertTrue($this->form->getTextField()->hasError());
        self::assertSame('Value is required.', $this->form->getTextField()->getError());

        self::assertSame('', $this->form->getPasswordField()->getValue());
        self::assertTrue($this->form->getPasswordField()->hasError());
        self::assertSame('Value is required.', $this->form->getPasswordField()->getError());

        self::assertSame('', $this->form->getNameField()->getValue());
        self::assertTrue($this->form->getNameField()->hasError());
        self::assertSame('Value is required.', $this->form->getNameField()->getError());
    }

    /**
     * Test process with invalid values in post request.
     */
    public function testProcessWithInvalidValuesInPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('not-required', 'invalid');
        $request->setFormParameter('text', 'invalid');
        $request->setFormParameter('password', 'invalid');
        $request->setFormParameter('name', 'invalid');

        $isProcessed = $this->form->process($request);

        self::assertFalse($isProcessed);

        self::assertSame('invalid', $this->form->getNotRequiredField()->getValue());
        self::assertTrue($this->form->getNotRequiredField()->hasError());
        self::assertSame('Value of not required field is invalid.', $this->form->getNotRequiredField()->getError());

        self::assertSame('invalid', $this->form->getTextField()->getValue());
        self::assertTrue($this->form->getTextField()->hasError());
        self::assertSame('Value of text field is invalid.', $this->form->getTextField()->getError());

        self::assertSame('invalid', $this->form->getPasswordField()->getValue());
        self::assertTrue($this->form->getPasswordField()->hasError());
        self::assertSame('Value of password field is invalid.', $this->form->getPasswordField()->getError());

        self::assertSame('Invalid', $this->form->getNameField()->getValue());
        self::assertTrue($this->form->getNameField()->hasError());
        self::assertSame('Value of name field is invalid.', $this->form->getNameField()->getError());
    }

    /**
     * Set up.
     */
    public function setUp()
    {
        $this->form = new BasicTestPostForm();
    }

    /**
     * Tear down.
     */
    public function tearDown()
    {
        $this->form = null;
    }

    /**
     * @var BasicTestPostForm My form.
     */
    private $form;
}
