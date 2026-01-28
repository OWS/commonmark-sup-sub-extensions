<?php

namespace Ows\CommonMark\Tests\Functional;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;
use Ows\CommonMark\SubExtension;
use Ows\CommonMark\SupExtension;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
 */
class SupSubTest extends TestCase {

  /**
   * Provides test data for the sub test.
   */
  public function subMarkupProvider(): array {
    return [
      ['10~2~', '<p>10<sub>2</sub></p>'],
    ];
  }

  /**
   * Provides test data for the sup test.
   */
  public function supMarkupProvider(): array {
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
    ];
  }

  /**
   * Test Sub extension.
   *
   * @dataProvider subMarkupProvider
   */
  public function testSub(string $markdown, string $html): void {
    $environment = Environment::createCommonMarkEnvironment();
    $environment->addExtension(new SubExtension());
    $converter = new MarkdownConverter($environment);

    $this->assertEquals($html, trim($converter->convertToHtml($markdown)));
  }

  /**
   * Test Sup extension.
   *
   * @dataProvider supMarkupProvider
   */
  public function testSup(string $markdown, string $html): void {
    $environment = Environment::createCommonMarkEnvironment();
    $environment->addExtension(new SupExtension());
    $converter = new MarkdownConverter($environment);

    $this->assertEquals($html, trim($converter->convertToHtml($markdown)));
  }

}
