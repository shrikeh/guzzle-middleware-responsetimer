<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Dotenv\Dotenv;

$loader = require __DIR__.'/../../vendor/autoload.php';

$envFile = __DIR__.'/../../.env';
if (is_readable($envFile)) {
    $dotEnv = new Dotenv();
    $dotEnv->load(__DIR__.'/../../.env');
}

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
