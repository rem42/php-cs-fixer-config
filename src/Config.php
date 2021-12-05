<?php

namespace Rem42\CS\Config;

use PhpCsFixer\Config as BaseConfig;

final class Config extends BaseConfig
{
    public function __construct()
    {
        parent::__construct('PHP 7.4');

        $this->setRiskyAllowed(true);
    }

    /**
     * @return array<string, bool|mixed>
     */
    public function getRules(): array
    {
        return [
            '@Symfony'            => true,
            '@Symfony:risky'      => true,
            '@PHP74Migration'     => true,
            '@PSR12'              => true,
            '@PSR12:risky'        => true,
            '@DoctrineAnnotation' => true,
            '@PhpCsFixer'         => true,
            'array_syntax'        => [
                'syntax' => 'short',
            ],
            'no_unreachable_default_argument_value' => false,
            'braces'                                => [
                'allow_single_line_closure' => true,
            ],
            'heredoc_to_nowdoc' => false,
            'phpdoc_summary'    => false,
            'increment_style'   => ['style' => 'post'],
            'yoda_style'        => true,
            'ordered_imports'   => ['sort_algorithm' => 'alpha'],
            'phpdoc_line_span'  => [
                'property' => 'single',
                'const'    => 'single',
            ],
            'align_multiline_comment'     => true,
            'array_indentation'           => true,
            'blank_line_before_statement' => [
                'statements' => [
                    'declare',
                    'do',
                    'for',
                    'foreach',
                    'if',
                    'switch',
                    'try',
                ],
            ],
            'declare_equal_normalize'             => true,
            'phpdoc_scalar'                       => false,
            'concat_space'                        => ['spacing' => 'one'],
            'binary_operator_spaces'              => ['default' => 'align_single_space_minimal'],
            'no_superfluous_phpdoc_tags'          => true,
            'no_empty_phpdoc'                     => true,
            'phpdoc_align'                        => true,
            'phpdoc_order'                        => true,
            'php_unit_test_class_requires_covers' => false,
        ];
    }
}
