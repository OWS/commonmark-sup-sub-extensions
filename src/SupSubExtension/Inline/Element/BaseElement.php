<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\SupSubExtension\Inline\Element;

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
    public function __construct($text = null)
    {
        parent::__construct();
        if ($text !== null) {
            $this->appendChild(new Text($text));
        }
    }
}
