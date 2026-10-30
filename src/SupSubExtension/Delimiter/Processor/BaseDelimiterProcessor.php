<?php

namespace Ows\CommonMark\SupSubExtension\Delimiter\Processor;

use League\CommonMark\Delimiter\DelimiterInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Node\Inline\AbstractStringContainer;


class BaseDelimiterProcessor implements DelimiterProcessorInterface
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
    return 1;
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
