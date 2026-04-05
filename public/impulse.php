<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Impulse\Core\Component\Handler\AjaxDispatcher;
use ScssPhp\ScssPhp\Exception\SassException;

try {
    (new AjaxDispatcher())->handle();
} catch (JsonException|DOMException|ReflectionException|SassException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}
