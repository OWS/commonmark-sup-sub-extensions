<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark\Inline\Parser;

use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\InlineParserContext;

abstract class BaseParser extends AbstractInlineParser
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
  public function getCharacters()
  {
    return [static::CHARACTER];
  }

  /**
   * {@inheritdoc}
   */
  public function parse(InlineParserContext $inlineContext)
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
