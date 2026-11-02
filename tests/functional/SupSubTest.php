<?php

namespace Ows\CommonMark\Tests\Functional;

use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;
use Ows\CommonMark\SupSubExtension\SubExtension;
use Ows\CommonMark\SupSubExtension\SupExtension;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
 */
class SupSubTest extends TestCase
{
    /**
     * Provides test data for the sub test.
     *
     * @return array<array-key, array{string, string}>
     */
    public static function subMarkupProvider(): array
    {
        return [
            ['10~2~', '<p>10<sub>2</sub></p>'],
            // Spaces are not allowed, unless as &nbsp;.
            ['a~b c~', '<p>a~b c~</p>'],
            ['a~b&nbsp;c~', "<p>a<sub>b\u{a0}c</sub></p>"],
        ];
    }

    /**
     * Provides test data for the sup test.
     *
     * @return array<array-key, array{string, string}>
     */
    public static function supMarkupProvider(): array
    {
        return [
            // Check standard operation.
            ['10^2^', '<p>10<sup>2</sup></p>'],
            // Check that escaping works correctly.
            ['a^b\^c^', '<p>a<sup>b^c</sup></p>'],
            // Ensure that sup and em can be nested properly.
            ['*a^b^c*', '<p><em>a<sup>b</sup>c</em></p>'],
            ['^a*b*^', '<p><sup>a<em>b</em></sup></p>'],
            // Ensure that sup and links play nicely together.
            ['^[a](https://example.com)^', '<p><sup><a href="https://example.com">a</a></sup></p>'],
            ['[a^b^](https://example.com)', '<p><a href="https://example.com">a<sup>b</sup></a></p>'],
            // Ensure that sup and header can be used together
            ['# a^b^', '<h1>a<sup>b</sup></h1>'],
            // Spaces and line breaks are not allowed, unless as &nbsp;.
            ['a^b c^', '<p>a^b c^</p>'],
            ["a^b\tc^", "<p>a^b\tc^</p>"],
            ["a^b\nc^", "<p>a^b\nc^</p>"],
            ['a^b&nbsp;c^', "<p>a<sup>b\u{a0}c</sup></p>"],
            ['a^b c^d^', '<p>a^b c<sup>d</sup></p>'],
            // Spaces inside nested inlines are allowed.
            ['^a*b c*^', '<p><sup>a<em>b c</em></sup></p>'],
            ['^[a b](https://example.com)^', '<p><sup><a href="https://example.com">a b</a></sup></p>'],
        ];
    }

    /**
     * Test Sub extension.
     *
     * @dataProvider subMarkupProvider
     */
    public function testSub(string $markdown, string $html): void
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new SubExtension());
        $converter = new MarkdownConverter($environment);

        $this->assertEquals($html, trim($converter->convert($markdown)));
    }

    /**
     * Test Sup extension.
     *
     * @dataProvider supMarkupProvider
     */
    public function testSup(string $markdown, string $html): void
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new SupExtension());
        $converter = new MarkdownConverter($environment);

        $this->assertEquals($html, trim($converter->convert($markdown)));
    }

    /**
     * Test deprecated extensions still work.
     */
    public function testDeprecatedExtensions(): void
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new \Ows\CommonMark\SupExtension());
        $environment->addExtension(new \Ows\CommonMark\SubExtension());
        $converter = new MarkdownConverter($environment);

        $this->assertEquals('<p>10<sup>2</sup> H<sub>2</sub>O</p>', trim($converter->convert('10^2^ H~2~O')));
    }
}
