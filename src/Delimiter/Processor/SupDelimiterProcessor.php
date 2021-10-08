<?php

namespace Ows\CommonMark\SupSubExtensions\Delimiter\Processor;

use Ows\CommonMark\SupSubExtensions\Inline\Element\Sup;

class SupDelimiterProcessor extends BaseDelimiterProcessor {

  /**
   * Construct a SupDelimiterProcessor.
   */
  public function __construct() {
    parent::__construct('^', Sup::class);
  }

}
