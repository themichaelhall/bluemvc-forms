<?php

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\SimpleTestPostForm;

/**
 * Test origin check in form.
 */
class CheckOriginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test origin check in form.
     *
     * @dataProvider checkOriginDataProvider
     *
     * @param string      $formUrl             The form url.
     * @param string|null $originHeader        The origin header.
     * @param string|null $referrerHeader      The referrer header.
     * @param bool        $expectedIsProcessed If true, form expects to be processed, false otherwise.
     */
    public function testCheckOrigin($formUrl, $originHeader, $referrerHeader, $expectedIsProcessed)
    {
        $request = new FakeRequest($formUrl, 'POST');
        if ($originHeader !== null) {
            $request->setHeader('Origin', $originHeader);
        }
        if ($referrerHeader !== null) {
            $request->setHeader('Referer', $referrerHeader);
        }
        $request->setFormParameter('text', 'My text');
        $form = new SimpleTestPostForm();
        $isProcessed = $form->process($request);

        self::assertSame($expectedIsProcessed, $isProcessed);
        self::assertSame($isProcessed ? 'My text' : '', $form->Text->getValue());
    }

    /**
     * Data provider for check origin tests.
     *
     * @return array The data.
     */
    public function checkOriginDataProvider()
    {
        return [
            ['http://example.com/form', null, null, true],
            ['http://example.com/form', null, 'http://example.com', true],
            ['http://example.com/form', null, 'http://foobar.com', false],
            ['http://example.com/form', null, 'Foo', false],
            ['http://example.com/form', 'http://example.com', null, true],
            ['http://example.com/form', 'http://example.com', 'http://example.com', true],
            ['http://example.com/form', 'http://example.com', 'http://foobar.com', false],
            ['http://example.com/form', 'http://example.com', 'Foo', false],
            ['http://example.com/form', 'http://foobar.com', null, false],
            ['http://example.com/form', 'http://foobar.com', 'http://example.com', false],
            ['http://example.com/form', 'http://foobar.com', 'http://foobar.com', false],
            ['http://example.com/form', 'http://foobar.com', 'Foo', false],
            ['http://example.com/form', 'Foo', null, false],
            ['http://example.com/form', 'Foo', 'http://example.com', false],
            ['http://example.com/form', 'Foo', 'http://foobar.com', false],
            ['http://example.com/form', 'Foo', 'Foo', false],
        ];
    }
}
