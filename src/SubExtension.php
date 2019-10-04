<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 *
 * Add subscript (<sub> tag) to league/commonmark.
 *
 * 10~2~ => 10<sub>2</sub>.
 */

namespace Ows\CommonMarkSupSubExtensions;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use Ows\CommonMarkSupSubExtensions\Delimiter\Processor\SubDelimiterProcessor;
use Ows\CommonMarkSupSubExtensions\Inline\Element\Sub;
use Ows\CommonMarkSupSubExtensions\Inline\Renderer\SubRenderer;

final class SubExtension implements ExtensionInterface
{

  /**
   * {@inheritdoc}
   */
  public function register(ConfigurableEnvironmentInterface $environment) {
    $environment
      ->addDelimiterProcessor(new SubDelimiterProcessor())
      ->addInlineRenderer(
        Sub::class,
        new SubRenderer()
      )
    ;
  }

}

