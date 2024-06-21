<?php
require_once __DIR__ . '/vendor/autoload.php';

use Wrql\Router\Router;

header("Content-Type: application/json");
$router = new Router();
$router->init(); 