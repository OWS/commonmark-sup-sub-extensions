<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Parser;

use League\CommonMark\InlineParserContext;
use League\CommonMark\Inline\Parser\InlineParserInterface;

class BaseParser implements InlineParserInterface
{

  /*
   * These elements must be overriden by extending classes:
   * - const CHARACTER,
   * - const REGEXP,
   * - property $elementClass.
   */
  const CHARACTER = '';
  const REGEXP = '//';
  protected $elementClass = '\stdClass';

  /**
   * {@inheritdoc}
   */
  public function getCharacters(): array
  {
    return [static::CHARACTER];
  }

  /**
   * {@inheritdoc}
   */
  public function parse(InlineParserContext $inlineContext): bool
  {
    $cursor = $inlineContext->getCursor();

    $previousChar = $cursor->peek(-1);
    // Always follows text.
    if ($previousChar === NULL) {
      return FALSE;
    }

    $previousState = $cursor->saveState();
    $handle = $cursor->match(static::REGEXP);
    if (empty($handle)) {
      $cursor->restoreState($previousState);
      return FALSE;
    }

    $inlineContext->getContainer()->appendChild(
      new $this->elementClass(str_replace(static::CHARACTER, '', $handle))
    );
    return TRUE;
  }

}
