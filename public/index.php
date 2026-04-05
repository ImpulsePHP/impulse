<?php

require dirname(__DIR__) . '/bootstrap.php';

use Impulse\Core\Http\Request;
use Impulse\Core\Http\Router\PageRouter;
use Impulse\Core\Support\LocalStorage;

LocalStorage::ingestRequestPayload();

$router = new PageRouter(getcwd() . '/../src/Page');
$router->handle(Request::createFromGlobals());
