<?php

use App\Core\Request;
use App\Core\Routing\Router;
const BASE_PATH = __DIR__ . "/../";
include BASE_PATH . "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
include BASE_PATH . "helpers/helper.php";
include BASE_PATH . "routes/web.php";
$request = new Request();
$router = new Router($request);