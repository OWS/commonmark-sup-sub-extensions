<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 *
 * Add superscript (<sup> tag) to league/commonmark.
 *
 * 10^2^ => 10<sup>2</sup>.
 */

namespace Ows\CommonMark;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use Ows\CommonMark\Delimiter\Processor\SupDelimiterProcessor;
use Ows\CommonMark\Inline\Element\Sup;
use Ows\CommonMark\Inline\Renderer\SupRenderer;

final class SupExtension implements ExtensionInterface
{

  /**
   * {@inheritdoc}
   */
  public function register(ConfigurableEnvironmentInterface $environment) {
    $environment
      ->addDelimiterProcessor(new SupDelimiterProcessor())
      ->addInlineRenderer(
        Sup::class,
        new SupRenderer()
      )
    ;
  }

}

