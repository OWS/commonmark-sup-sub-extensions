<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 *
 * Add subscript (<sub> tag) to league/commonmark.
 *
 * 10~2~ => 10<sub>2</sub>.
 */

namespace Ows\CommonMark;

use Ows\CommonMark\Inline\Parser\SubParser;
use Ows\CommonMark\Inline\Renderer\SubRenderer;
use League\CommonMark\Extension\Extension;

class SubExtension extends Extension
{

  /**
   * {@inheritdoc}
   */
  public function getInlineParsers()
  {
    return [
      new SubParser(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getInlineRenderers()
  {
    return [
      'Ows\CommonMark\Inline\Element\Sub' => new SubRenderer(),
    ];
  }

}
