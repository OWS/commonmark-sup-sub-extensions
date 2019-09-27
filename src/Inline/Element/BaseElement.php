<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Element;

use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Text;

abstract class BaseElement extends AbstractInline
{

  /**
   * Base constructor for sub and sup elements.
   *
   * @param string $text
   *   Text to put in element.
   */
  public function __construct($text)
  {
    $this->appendChild(new Text($text));
  }

}
