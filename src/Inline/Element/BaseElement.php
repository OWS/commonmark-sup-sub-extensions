<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Element;

use League\CommonMark\Node\Inline\AbstractInline;
use League\CommonMark\Node\Inline\Text;

abstract class BaseElement extends AbstractInline
{

  /**
   * Base constructor for sub and sup elements.
   *
   * @param string $text
   *   Text to put in element.
   */
  public function __construct($text = NULL)
  {
    if ($text) {
      $this->appendChild(new Text($text));
    }
    parent::__construct($text);
  }

}
