<?php

namespace Ows\CommonMark\Tests\Functional;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\MarkdownConverter;
use Ows\CommonMark\SupSubExtension\SubExtension;
use Ows\CommonMark\SupSubExtension\SupExtension;
use PHPUnit\Framework\Attributes\DataProvider;
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
            // Check standard operation.
            ['10~2~', '<p>10<sub>2</sub></p>'],
            // Check that escaping works correctly.
            ['a~b\~c~', '<p>a<sub>b~c</sub></p>'],
            // Ensure that sub and em can be nested properly.
            ['*a~b~c*', '<p><em>a<sub>b</sub>c</em></p>'],
            ['~a*b*~', '<p><sub>a<em>b</em></sub></p>'],
            // Ensure that sub and links play nicely together.
            ['~[a](https://example.com)~', '<p><sub><a href="https://example.com">a</a></sub></p>'],
            ['[a~b~](https://example.com)', '<p><a href="https://example.com">a<sub>b</sub></a></p>'],
            // Ensure that sub and header can be used together
            ['# a~b~', '<h1>a<sub>b</sub></h1>'],
            // Spaces and line breaks are not allowed, unless as &nbsp;.
            ['a~b c~', '<p>a~b c~</p>'],
            ["a~b\tc~", "<p>a~b\tc~</p>"],
            ["a~b\nc~", "<p>a~b\nc~</p>"],
            ['a~b&nbsp;c~', "<p>a<sub>b\u{a0}c</sub></p>"],
            ['a~b c~d~', '<p>a~b c<sub>d</sub></p>'],
            // Spaces inside nested inlines are allowed.
            ['~a*b c*~', '<p><sub>a<em>b c</em></sub></p>'],
            ['~[a b](https://example.com)~', '<p><sub><a href="https://example.com">a b</a></sub></p>'],
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
     * Provides test data for the cohabitation test.
     *
     * @return array<array-key, array{string, string, list<ExtensionInterface>}>
     */
    public static function cohabitationMarkupProvider(): array
    {
        return [
            // Delimiters inside inline code are left untouched.
            ['`a^b^ c~d~`', '<p><code>a^b^ c~d~</code></p>', []],
            // Tilde fenced code blocks still work.
            ["~~~\na~b~\n~~~", "<pre><code>a~b~\n</code></pre>", []],
            ["~~~ php\na^b^\n~~~", "<pre><code class=\"language-php\">a^b^\n</code></pre>", []],
            // Footnote references use a caret too.
            [
                "a^b^ x[^1]\n\n[^1]: c^d^",
                '<p>a<sup>b</sup> x<sup id="fnref:1"><a class="footnote-ref" href="#fn:1" role="doc-noteref">1</a></sup></p>'
                . "\n" . '<div class="footnotes" role="doc-endnotes"><hr /><ol><li class="footnote" id="fn:1" role="doc-endnote"><p>c<sup>d</sup>&nbsp;<a class="footnote-backref" rev="footnote" href="#fnref:1" role="doc-backlink">↩</a></p></li></ol></div>',
                [new FootnoteExtension()],
            ],
            // Attributes apply to sup and sub elements.
            ['a^b^{.c} d~e~{#f}', '<p>a<sup class="c">b</sup> d<sub id="f">e</sub></p>', [new AttributesExtension()]],
        ];
    }

    /**
     * Test Sub extension.
     */
    #[DataProvider('subMarkupProvider')]
    public function testSub(string $markdown, string $html): void
    {
        $this->assertConverts($markdown, $html, [new SubExtension()]);
    }

    /**
     * Test Sup extension.
     */
    #[DataProvider('supMarkupProvider')]
    public function testSup(string $markdown, string $html): void
    {
        $this->assertConverts($markdown, $html, [new SupExtension()]);
    }

    /**
     * Test both extensions along with other syntaxes and extensions.
     *
     * @param list<ExtensionInterface> $extensions
     */
    #[DataProvider('cohabitationMarkupProvider')]
    public function testCohabitation(string $markdown, string $html, array $extensions): void
    {
        $this->assertConverts($markdown, $html, [new SupExtension(), new SubExtension(), ...$extensions]);
    }

    /**
     * Test deprecated extensions still work.
     */
    public function testDeprecatedExtensions(): void
    {
        $this->assertConverts('10^2^ H~2~O', '<p>10<sup>2</sup> H<sub>2</sub>O</p>', [
            new \Ows\CommonMark\SupExtension(),
            new \Ows\CommonMark\SubExtension(),
        ]);
    }

    /**
     * Asserts that the markdown is converted to the expected HTML.
     *
     * @param list<ExtensionInterface> $extensions
     */
    private function assertConverts(string $markdown, string $html, array $extensions): void
    {
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        foreach ($extensions as $extension) {
            $environment->addExtension($extension);
        }
        $converter = new MarkdownConverter($environment);

        $this->assertSame($html, trim($converter->convert($markdown)->getContent()));
    }
}
