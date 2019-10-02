<?php

namespace Ows\CommonMark\Delimiter\Processor;

use Ows\CommonMark\Inline\Element\Sub;

class SubDelimiterProcessor extends BaseDelimiterProcessor {

  /**
   * Construct a SupDelimiterProcessor.
   */
  public function __construct() {
    parent::__construct('~', Sub::class);
  }

}
