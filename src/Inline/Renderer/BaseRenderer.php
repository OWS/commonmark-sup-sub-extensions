<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMarkSupSubExtensions\Inline\Renderer;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\Xml;

abstract class BaseRenderer implements InlineRendererInterface
{

  /*
   * These elements must be overriden by extending classes:
   * - const TAG,
   * - property $elementClass.
   */
  const TAG = 'span';
  protected $elementClass = '\stdClass';

  /**
   * {@inheritdoc}
   */
  public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
  {
    if (!($inline instanceof $this->elementClass)) {
      throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
    }

    $attrs = [];
    foreach ($inline->getData('attributes', []) as $key => $value) {
      $attrs[$key] = Xml::escape($value);
    }

    return new HtmlElement(static::TAG, $attrs, $htmlRenderer->renderInlines($inline->children()));
  }

}
