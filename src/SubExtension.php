<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 *
 * Add subscript (<sub> tag) to league/commonmark.
 *
 * 10~2~ => 10<sub>2</sub>.
 */

namespace Ows\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ExtensionInterface;
use Ows\CommonMark\Delimiter\Processor\SubDelimiterProcessor;
use Ows\CommonMark\Inline\Element\Sub;
use Ows\CommonMark\Inline\Renderer\SubRenderer;

final class SubExtension implements ExtensionInterface
{

  /**
   * {@inheritdoc}
   */
  public function register(EnvironmentBuilderInterface $environment): void
  {
    $environment
      ->addDelimiterProcessor(new SubDelimiterProcessor())
      ->addRenderer(
        Sub::class,
        new SubRenderer()
      )
    ;
  }

}

