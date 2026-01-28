<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Renderer;

class SubRenderer extends BaseRenderer
{

  public const string TAG = 'sub';
  protected string $elementClass = '\Ows\CommonMark\Inline\Element\Sub';

}
