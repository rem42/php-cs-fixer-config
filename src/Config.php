<?php

declare(strict_types=1);

namespace Rem42\CS\Config;

use PhpCsFixer\Config as BaseConfig;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use PhpCsFixerCustomFixers as CustomFixers;

class Config extends BaseConfig
{
    /** @var array<string, bool|mixed> */
    protected array $rules = [];

    public function __construct(
        private bool $customFixers = false,
        private bool $enableRisky = false,
    ) {
        parent::__construct('Rem42 PHP >= 8.0 config');
        $this->registerCustomFixers(new CustomFixers\Fixers());
        $this->setParallelConfig(ParallelConfigFactory::detect());
    }

    /**
     * @return array<string, bool|mixed>
     */
    public function getRules(): array
    {
        return array_merge(
            $this->addDefaultRules(),
            $this->addRiskyRules(),
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
    public function addDefaultRules(): array
    {
        $rules = [
            '@DoctrineAnnotation' => true,
            '@PER-CS2.0' => true,
            '@PHP80Migration' => true,
            '@PSR12' => true,
            '@PhpCsFixer' => true,
            '@Symfony' => true,

            // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.65|configurator|fixer:phpdoc_line_span
            'phpdoc_line_span' => [
                'property' => 'single',
                'const' => 'single',
            ],

            // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.65|configurator|fixer:phpdoc_param_order
            'phpdoc_param_order' => true,

            // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.65|configurator|fixer:phpdoc_to_comment
            // Permet de faire un @var sur une seule ligne
            'phpdoc_to_comment' => ['ignored_tags' => ['var']],

            // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.65|configurator|fixer:php_unit_test_class_requires_covers
            'php_unit_test_class_requires_covers' => false,

            'phpdoc_array_type' => true,

            'blank_line_before_statement' => [
                'statements' => [
                    'declare',
                    'do',
                    'for',
                    'foreach',
                    'if',
                    'phpdoc',
                    'return',
                    'switch',
                    'try',
                    'while',
                ],
            ],

            'single_line_empty_body' => true,
            'concat_space' => ['spacing' => 'one'],
        ];

        if (\PHP_VERSION_ID >= 81000) {
            $rules['@PHP81Migration'] = true;
        }

        if (\PHP_VERSION_ID >= 82000) {
            $rules['@PHP82Migration'] = true;
        }

        if (\PHP_VERSION_ID >= 83000) {
            $rules['@PHP83Migration'] = true;
        }

        return $rules;
    }

    /**
     * @return array<string, bool|mixed>
     */
    private function addRiskyRules(): array
    {
        if (!$this->enableRisky) {
            return [];
        }

        $rules = [
            '@PER-CS2.0:risky' => true,
            '@PHP80Migration:risky' => true,
            '@PSR12:risky' => true,
            '@PhpCsFixer:risky' => true,
            '@Symfony:risky' => true,

            // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.65|configurator|fixer:no_unreachable_default_argument_value
            'no_unreachable_default_argument_value' => false,
        ];

        if (\PHP_VERSION_ID >= 82000) {
            $rules['@PHP82Migration:risky'] = true;
        }

        return $rules;
    }

    /**
     * @return array<string, bool>
     */
    protected function addCustomRules(): array
    {
        if (!$this->customFixers) {
            return [];
        }

        return [
            CustomFixers\Fixer\CommentSurroundedBySpacesFixer::name() => true,
            CustomFixers\Fixer\MultilineCommentOpeningClosingAloneFixer::name() => true,
            CustomFixers\Fixer\MultilinePromotedPropertiesFixer::name() => true,
            CustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer::name() => true,
            CustomFixers\Fixer\NoDuplicatedArrayKeyFixer::name() => true,
            CustomFixers\Fixer\NoDuplicatedImportsFixer::name() => true,
            CustomFixers\Fixer\NoImportFromGlobalNamespaceFixer::name() => true,
            CustomFixers\Fixer\NoUselessCommentFixer::name() => true,
            CustomFixers\Fixer\NoUselessDirnameCallFixer::name() => true,
            CustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer::name() => true,
            CustomFixers\Fixer\NoUselessParenthesisFixer::name() => true,
            CustomFixers\Fixer\NoUselessStrlenFixer::name() => true,
            CustomFixers\Fixer\PhpdocNoSuperfluousParamFixer::name() => true,
            CustomFixers\Fixer\PhpdocSelfAccessorFixer::name() => true,
            CustomFixers\Fixer\PhpdocSingleLineVarFixer::name() => true,
            CustomFixers\Fixer\PhpdocTypesCommaSpacesFixer::name() => true,
            CustomFixers\Fixer\PhpdocTypesTrimFixer::name() => true,
            CustomFixers\Fixer\SingleSpaceAfterStatementFixer::name() => true,
            CustomFixers\Fixer\SingleSpaceBeforeStatementFixer::name() => true,
            CustomFixers\Fixer\StringableInterfaceFixer::name() => true,
        ];
    }
}
