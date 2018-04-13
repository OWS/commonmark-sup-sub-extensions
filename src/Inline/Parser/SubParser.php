<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Parser;

class SubParser extends BaseParser
{

  const CHARACTER = '~';
  const REGEXP = '/~([^~]+)~/';
  protected $elementClass = '\Ows\CommonMark\Inline\Element\Sub';

}
