<?php

namespace Ows\CommonMarkSupSubExtensions\Delimiter\Processor;

use Ows\CommonMarkSupSubExtensions\Inline\Element\Sub;

class SubDelimiterProcessor extends BaseDelimiterProcessor {

  /**
   * Construct a SupDelimiterProcessor.
   */
  public function __construct() {
    parent::__construct('~', Sub::class);
  }

}
