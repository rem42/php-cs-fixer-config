<?php declare(strict_types=1);

namespace Rem42\CS\Config;

use PhpCsFixer\Config as BaseConfig;
use PhpCsFixerCustomFixers as CustomFixers;

class Config extends BaseConfig
{
    /** @var array<string, bool|mixed> */
    protected array $rules = [];

    public function __construct()
    {
        parent::__construct('Rem42 PHP >= 7.4 config');

        $this->registerCustomFixers(new CustomFixers\Fixers());
        $this->setRiskyAllowed(true);
    }

    /**
     * @return array<string, bool|mixed>
     */
    public function getRules(): array
    {
        return array_merge(
            $this->addDefaultRules(),
            $this->addCustomRules(),
            $this->rules,
        );
    }

    /**
     * @param array<string, bool|mixed> $rules
     */
    public function addMoreRules(array $rules = []): self
    {
        $this->rules = array_merge($this->rules, $rules);
        return $this;
    }

    /**
     * @return array<string, bool|mixed>
     */
    protected function addDefaultRules(): array
    {
        return [
            '@DoctrineAnnotation' => true,
            '@PHP74Migration' => true,
            '@PhpCsFixer' => true,
            '@PSR12' => true,
            '@PSR12:risky' => true,
            '@Symfony' => true,
            '@Symfony:risky' => true,
            'array_indentation' => true,
            'align_multiline_comment' => true,
            'array_syntax' => [
                'syntax' => 'short',
            ],
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
            'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
            'binary_operator_spaces' => ['default' => 'single_space'],
            'braces' => ['allow_single_line_closure' => true],
            'concat_space' => ['spacing' => 'one'],
            'declare_equal_normalize' => true,
            'heredoc_to_nowdoc' => false,
            'increment_style' => ['style' => 'post'],
            'no_empty_phpdoc' => true,
            'no_superfluous_phpdoc_tags' => true,
            'no_unreachable_default_argument_value' => false,
            'ordered_imports' => ['sort_algorithm' => 'alpha'],
            'phpdoc_align' => true,
            'phpdoc_line_span' => [
                'property' => 'single',
                'const' => 'single',
            ],
            'phpdoc_order' => true,
            'phpdoc_scalar' => false,
            'phpdoc_summary' => false,
            'phpdoc_to_comment' => ['ignored_tags' => ['var']],
            'php_unit_test_class_requires_covers' => false,
            'yoda_style' => true,
        ];
    }

    /**
     * @return array<string, bool>
     */
    protected function addCustomRules(): array
    {
        return [
            CustomFixers\Fixer\CommentSurroundedBySpacesFixer::name() => true,
            CustomFixers\Fixer\ConstructorEmptyBracesFixer::name() => true,
            CustomFixers\Fixer\DeclareAfterOpeningTagFixer::name() => true,
            CustomFixers\Fixer\MultilinePromotedPropertiesFixer::name() => true,
            CustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer::name() => true,
            CustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer::name() => true,
            CustomFixers\Fixer\NoUselessStrlenFixer::name() => true,
            CustomFixers\Fixer\PhpdocArrayStyleFixer::name() => true,
            CustomFixers\Fixer\PhpdocParamOrderFixer::name() => true,
            CustomFixers\Fixer\PhpdocSelfAccessorFixer::name() => true,
            CustomFixers\Fixer\PhpdocTypesCommaSpacesFixer::name() => true,
            CustomFixers\Fixer\StringableInterfaceFixer::name() => true,
        ];
    }
}
