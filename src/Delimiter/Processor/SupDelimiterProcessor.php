<?php

namespace Ows\CommonMarkSupSubExtensions\Delimiter\Processor;

use Ows\CommonMarkSupSubExtensions\Inline\Element\Sup;

class SupDelimiterProcessor extends BaseDelimiterProcessor {

  /**
   * Construct a SupDelimiterProcessor.
   */
  public function __construct() {
    parent::__construct('^', Sup::class);
  }

}
