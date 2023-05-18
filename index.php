<?php


use App\Controller\ParserController;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', ParserController::class . ':handle');

$app->run();