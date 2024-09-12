<?php


$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')   // Include the src directory
    ->in(__DIR__ . '/libs') // Include the tests directory
    ->in(__DIR__ . '/tests') // Include the tests directory
    ->name('*.php');          // Include all PHP files

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS2.0'                      => true,
        'no_unneeded_control_parentheses' => true,
        'no_unused_imports'               => true,
        'ordered_imports'                 => ['sort_algorithm' => 'alpha'],
        'align_multiline_comment'         => true,
        'array_syntax'                    => ['syntax' => 'short'],
        'no_extra_blank_lines'            => [
            'tokens' => [
                'curly_brace_block',
                'parenthesis_brace_block',
                'square_brace_block',
                'use',
            ],
        ],
        'binary_operator_spaces' => [
            'default'   => 'single_space',
            'operators' => [
                '=>' => 'align_single_space',
            ],
        ],
    ])
    ->setFinder($finder);
