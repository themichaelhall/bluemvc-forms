<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\BasicTestPostForm;

require_once __DIR__ . '/Helpers/TestForms/BasicTestPostForm.php';

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

        $this->assertFalse($isProcessed);

        $this->assertSame('', $this->form->getTextField()->getValue());
        $this->assertFalse($this->form->getTextField()->hasError());
    }

    /**
     * Test process with post request.
     */
    public function testProcessWithPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('text', 'My text value');

        $isProcessed = $this->form->process($request);

        $this->assertTrue($isProcessed);

        $this->assertSame('My text value', $this->form->getTextField()->getValue());
        $this->assertFalse($this->form->getTextField()->hasError());
    }

    /**
     * Test process with empty post request.
     */
    public function testProcessWithEmptyPostRequest()
    {
        $request = new FakeRequest('/', 'POST');

        $isProcessed = $this->form->process($request);

        $this->assertFalse($isProcessed);

        $this->assertSame('', $this->form->getTextField()->getValue());
        $this->assertTrue($this->form->getTextField()->hasError());
        $this->assertSame('Value is required.', $this->form->getTextField()->getError());
    }

    /**
     * Test process with invalid values in post request.
     */
    public function testProcessWithInvalidValuesInPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('text', 'invalid');

        $isProcessed = $this->form->process($request);

        $this->assertFalse($isProcessed);

        $this->assertSame('invalid', $this->form->getTextField()->getValue());
        $this->assertTrue($this->form->getTextField()->hasError());
        $this->assertSame('Value is invalid.', $this->form->getTextField()->getError());
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
