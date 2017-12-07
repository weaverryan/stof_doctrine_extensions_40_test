<?php

use App\Entity\BraveElephant;
use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/vendor/autoload.php';

// The check is to ensure we don't use .env in production
(new Dotenv())->load(__DIR__.'/.env');
umask(0000);

Debug::enable();

$kernel = new Kernel($_SERVER['APP_ENV'] ?? 'dev', $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev')));
$kernel->boot();
$container = $kernel->getContainer();

$em = $container->get('doctrine.orm.entity_manager');
$elephant = new BraveElephant();
$em->persist($elephant);
$em->flush();
