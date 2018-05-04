<?php

declare(strict_types=1);

namespace BlueMvc\Forms\Tests;

use BlueMvc\Fakes\FakeRequest;
use BlueMvc\Forms\Tests\Helpers\TestForms\SimpleTestPostForm;
use PHPUnit\Framework\TestCase;

/**
 * Test origin check in form.
 */
class CheckOriginTest extends TestCase
{
    /**
     * Test isCheckOriginEnabled method.
     */
    public function testIsCheckOriginEnabled()
    {
        $form = new SimpleTestPostForm();

        self::assertTrue($form->isCheckOriginEnabled());
    }

    /**
     * Test setCheckOriginEnabled method.
     */
    public function testSetCheckOriginEnabled()
    {
        $form = new SimpleTestPostForm();
        $form->setCheckOriginEnabled(false);

        self::assertFalse($form->isCheckOriginEnabled());
    }

    /**
     * Test origin check in form.
     *
     * @dataProvider checkOriginDataProvider
     *
     * @param string      $formUrl             The form url.
     * @param bool        $checkOriginEnabled  True if check origin is enabled, false otherwise.
     * @param string|null $originHeader        The origin header.
     * @param string|null $referrerHeader      The referrer header.
     * @param bool        $expectedIsProcessed If true, form expects to be processed, false otherwise.
     */
    public function testCheckOrigin(string $formUrl, bool $checkOriginEnabled, ?string $originHeader, ?string $referrerHeader, bool $expectedIsProcessed)
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
        $form->setCheckOriginEnabled($checkOriginEnabled);
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
            ['http://example.com/form', true, null, null, true],
            ['http://example.com/form', true, null, 'http://example.com', true],
            ['http://example.com/form', true, null, 'http://foobar.com', false],
            ['http://example.com/form', true, null, 'Foo', false],
            ['http://example.com/form', true, 'http://example.com', null, true],
            ['http://example.com/form', true, 'http://example.com', 'http://example.com', true],
            ['http://example.com/form', true, 'http://example.com', 'http://foobar.com', false],
            ['http://example.com/form', true, 'http://example.com', 'Foo', false],
            ['http://example.com/form', true, 'http://foobar.com', null, false],
            ['http://example.com/form', true, 'http://foobar.com', 'http://example.com', false],
            ['http://example.com/form', true, 'http://foobar.com', 'http://foobar.com', false],
            ['http://example.com/form', true, 'http://foobar.com', 'Foo', false],
            ['http://example.com/form', true, 'Foo', null, false],
            ['http://example.com/form', true, 'Foo', 'http://example.com', false],
            ['http://example.com/form', true, 'Foo', 'http://foobar.com', false],
            ['http://example.com/form', true, 'Foo', 'Foo', false],
            ['http://example.com/form', false, null, null, true],
            ['http://example.com/form', false, null, 'http://example.com', true],
            ['http://example.com/form', false, null, 'http://foobar.com', true],
            ['http://example.com/form', false, null, 'Foo', true],
            ['http://example.com/form', false, 'http://example.com', null, true],
            ['http://example.com/form', false, 'http://example.com', 'http://example.com', true],
            ['http://example.com/form', false, 'http://example.com', 'http://foobar.com', true],
            ['http://example.com/form', false, 'http://example.com', 'Foo', true],
            ['http://example.com/form', false, 'http://foobar.com', null, true],
            ['http://example.com/form', false, 'http://foobar.com', 'http://example.com', true],
            ['http://example.com/form', false, 'http://foobar.com', 'http://foobar.com', true],
            ['http://example.com/form', false, 'http://foobar.com', 'Foo', true],
            ['http://example.com/form', false, 'Foo', null, true],
            ['http://example.com/form', false, 'Foo', 'http://example.com', true],
            ['http://example.com/form', false, 'Foo', 'http://foobar.com', true],
            ['http://example.com/form', false, 'Foo', 'Foo', true],
        ];
    }
}
