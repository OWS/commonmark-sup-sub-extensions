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
   */
  public function testSup() {
    $markdown = '10^2^';
    $html = '<p>10<sup>2</sup></p>';

    $environment = Environment::createCommonMarkEnvironment();
    $environment->addExtension(new SupExtension());
    $converter = new CommonMarkConverter([], $environment);

    $this->assertEquals($html, trim($converter->convertToHtml($markdown)));
  }

  /**
   * Test Sub extension.
   */
  public function testSub() {
    $markdown = '10~2~';
    $html = '<p>10<sub>2</sub></p>';

    $environment = Environment::createCommonMarkEnvironment();
    $environment->addExtension(new SubExtension());
    $converter = new CommonMarkConverter([], $environment);

    $this->assertEquals($html, trim($converter->convertToHtml($markdown)));
  }

}
