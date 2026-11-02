<?php

namespace Ows\CommonMark\SupSubExtension\Delimiter\Processor;

use Ows\CommonMark\SupSubExtension\Inline\Element\Sup;

class SupDelimiterProcessor extends BaseDelimiterProcessor
{
    /**
     * Construct a SupDelimiterProcessor.
     */
    public function __construct()
    {
        parent::__construct('^', Sup::class);
    }
}
