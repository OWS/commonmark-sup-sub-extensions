<?php

namespace Ows\CommonMark\Delimiter\Processor;

use Ows\CommonMark\Inline\Element\Sup;

class SupDelimiterProcessor extends BaseDelimiterProcessor {

  /**
   * Construct a SupDelimiterProcessor.
   */
  public function __construct() {
    parent::__construct('^', Sup::class);
  }

}
