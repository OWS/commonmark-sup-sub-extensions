<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\SupSubExtension\Inline\Renderer;

class SupRenderer extends BaseRenderer
{
    public const string TAG = 'sup';
    protected string $elementClass = '\Ows\CommonMark\SupSubExtension\Inline\Element\Sup';
}
