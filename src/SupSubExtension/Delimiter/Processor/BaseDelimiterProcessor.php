<?php

namespace Ows\CommonMark\SupSubExtension\Delimiter\Processor;

use League\CommonMark\Delimiter\DelimiterInterface;
use League\CommonMark\Delimiter\Processor\CacheableDelimiterProcessorInterface;
use League\CommonMark\Node\Inline\AbstractStringContainer;
use League\CommonMark\Node\Inline\Newline;
use League\CommonMark\Node\Inline\Text;

class BaseDelimiterProcessor implements CacheableDelimiterProcessorInterface
{
    /** @var string */
    private $delimiter;

    /** @var string */
    private $elementClass;

    /**
     * Construct a new base parser.
     *
     * @param string $delimiter
     *   The delimiter to use.
     * @param string $elementClass
     *   The element class to use
     */
    public function __construct(string $delimiter, string $elementClass)
    {
        $this->delimiter = $delimiter;
        $this->elementClass = $elementClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getOpeningCharacter(): string
    {
        return $this->delimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function getClosingCharacter(): string
    {
        return $this->delimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function getMinLength(): int
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int
    {
        $closerNode = $closer->getInlineNode();
        for ($node = $opener->getInlineNode()->next(); $node !== null && $node !== $closerNode; $node = $node->next()) {
            if ($node instanceof Newline || ($node instanceof Text && strpbrk($node->getLiteral(), " \t") !== false)) {
                return 0;
            }
        }

        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey(DelimiterInterface $closer): string
    {
        return $this->delimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void
    {
        /** @var \League\CommonMark\Node\Node $element */
        $element = new $this->elementClass();

        $next = $opener->next();
        while ($next !== null && $next !== $closer) {
            $tmp = $next->next();
            $element->appendChild($next);
            $next = $tmp;
        }

        $opener->insertAfter($element);
    }
}
