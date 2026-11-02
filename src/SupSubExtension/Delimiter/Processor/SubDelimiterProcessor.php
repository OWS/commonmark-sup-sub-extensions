<?php

namespace Ows\CommonMark\SupSubExtension\Delimiter\Processor;

use Ows\CommonMark\SupSubExtension\Inline\Element\Sub;

class SubDelimiterProcessor extends BaseDelimiterProcessor
{
    /**
     * Construct a SupDelimiterProcessor.
     */
    public function __construct()
    {
        parent::__construct('~', Sub::class);
    }
}
