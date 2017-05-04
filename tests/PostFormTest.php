<?php

use BlueMvc\Fakes\FakeRequest;

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

        self::assertFalse($isProcessed);
        self::assertSame('', $this->form->getTextField()->getValue());
    }

    /**
     * Test process with post request.
     */
    public function testProcessWithPostRequest()
    {
        $request = new FakeRequest('/', 'POST');
        $request->setFormParameter('text', 'My text value');

        $isProcessed = $this->form->process($request);

        self::assertTrue($isProcessed);
        self::assertSame('My text value', $this->form->getTextField()->getValue());
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
