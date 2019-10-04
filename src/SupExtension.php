<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 *
 * Add superscript (<sup> tag) to league/commonmark.
 *
 * 10^2^ => 10<sup>2</sup>.
 */

namespace Ows\CommonMarkSupSubExtensions;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use Ows\CommonMarkSupSubExtensions\Delimiter\Processor\SupDelimiterProcessor;
use Ows\CommonMarkSupSubExtensions\Inline\Element\Sup;
use Ows\CommonMarkSupSubExtensions\Inline\Renderer\SupRenderer;

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

