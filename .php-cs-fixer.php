<?php

$config = new Rem42\CS\Config\Config;
$config->getFinder()
    ->in([
       __DIR__.'/src'
    ]);

return $config;
