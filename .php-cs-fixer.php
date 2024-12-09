<?php

$config = new Rem42\CS\Config\Config(true, true);
$config
    ->addMoreRules([
        'declare_strict_types' => true,
    ])
    ->setRiskyAllowed(true)
    ->getFinder()
    ->in([
        __DIR__.'/src',
    ])
;

return $config;
