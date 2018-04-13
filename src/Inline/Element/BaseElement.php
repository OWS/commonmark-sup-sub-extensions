<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Element;

use League\CommonMark\Inline\Element\AbstractInlineContainer;
use League\CommonMark\Inline\Element\Text;

abstract class BaseElement extends AbstractInlineContainer
{

  /**
   * Sup constructor.
   *
   * @param string $text
   *   Text to put in element.
   */
  public function __construct($text)
  {
    $this->appendChild(new Text($text));
  }

}
