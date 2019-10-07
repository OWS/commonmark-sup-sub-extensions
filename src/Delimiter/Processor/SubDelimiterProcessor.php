<?php

namespace Ows\CommonMark\SupSubExtensions\Delimiter\Processor;

use Ows\CommonMark\SupSubExtensions\Inline\Element\Sub;

class SubDelimiterProcessor extends BaseDelimiterProcessor {

  /**
   * Construct a SupDelimiterProcessor.
   */
  public function __construct() {
    parent::__construct('~', Sub::class);
  }

}
