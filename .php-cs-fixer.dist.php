<?php

$finder = (new PhpCsFixer\Finder())
    ->in([__DIR__ . '/src', __DIR__ . '/tests']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_indentation' => true,
        'method_chaining_indentation' => true,
        'no_extra_blank_lines' => ['tokens' => ['curly_brace_block', 'extra', 'use']],
        'no_unused_imports' => true,
    ])
    ->setFinder($finder);
