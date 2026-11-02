<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\SupSubExtension\Inline\Renderer;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

abstract class BaseRenderer implements NodeRendererInterface
{
    /*
     * These elements must be overriden by extending classes:
     * - const TAG,
     * - property $elementClass.
     */
    public const string TAG = 'span';
    protected string $elementClass = '\stdClass';

    /**
     * {@inheritdoc}
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        if (!($node instanceof $this->elementClass)) {
            throw new \InvalidArgumentException('Incompatible node type: ' . get_class($node));
        }

        /** @var array<string, array<string>|bool|string> $attrs */
        $attrs = $node->data->get('attributes') ?: [];
        $contents = $childRenderer->renderNodes($node->children());
        return new HtmlElement(static::TAG, $attrs, $contents);
    }
}
