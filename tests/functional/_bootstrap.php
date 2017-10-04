<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Dotenv\Dotenv;

$loader = require __DIR__.'/../../vendor/autoload.php';

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__.'/../../.env');

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
