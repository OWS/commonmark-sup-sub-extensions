<?php

namespace Ows\CommonMark\Tests\Functional;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Ows\CommonMark\SubExtension;
use Ows\CommonMark\SupExtension;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
 */
class SupSubTest extends TestCase {

  /**
   * Test Sup extension.
   *
   * @dataProvider supMarkupProvider
   */
  public function testSup($markdown, $html) {
    $environment = Environment::createCommonMarkEnvironment();
    $environment->addExtension(new SupExtension());
    $converter = new CommonMarkConverter([], $environment);

    $this->assertEquals($html, trim($converter->convertToHtml($markdown)));
  }

  /**
   * Provides test data for the sup test.
   */
  public function supMarkupProvider() {
    return [
      ['10^2^', '<p>10<sup>2</sup></p>'],
    ];
  }

  /**
   * Test Sub extension.
   *
   * @dataProvider subMarkupProvider
   */
  public function testSub($markdown, $html) {
    $environment = Environment::createCommonMarkEnvironment();
    $environment->addExtension(new SubExtension());
    $converter = new CommonMarkConverter([], $environment);

    $this->assertEquals($html, trim($converter->convertToHtml($markdown)));
  }

  /**
   * Provides test data for the sub test.
   */
  public function subMarkupProvider() {
    return [
      ['10~2~', '<p>10<sub>2</sub></p>'],
    ];
  }

}
