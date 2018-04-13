<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 *
 * Add superscript (<sup> tag) to league/commonmark.
 *
 * 10^2^ => 10<sup>2</sup>.
 */

namespace Ows\CommonMark;

use Ows\CommonMark\Inline\Parser\SupParser;
use Ows\CommonMark\Inline\Renderer\SupRenderer;
use League\CommonMark\Extension\Extension;

class SupExtension extends Extension
{

  /**
   * {@inheritdoc}
   */
  public function getInlineParsers()
  {
    return [
      new SupParser(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getInlineRenderers()
  {
    return [
      'Ows\CommonMark\Inline\Element\Sup' => new SupRenderer(),
    ];
  }

}
