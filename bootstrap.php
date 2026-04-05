<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Impulse\Core\App;
use Impulse\Core\Exceptions\ImpulseException;
use Impulse\Core\Support\Config;

const IMPULSE_RENDERER_NAMESPACE_MAP = [
    'Impulse\\Core\\Renderer\\' => __DIR__ . '/vendor/impulsephp/core/src/Renderer',
    'App\\Renderer\\' => __DIR__ . '/src/Renderer',
];

Config::set('template_engine', null);
Config::set('template_path', 'views');

try {
    App::boot();
} catch (ReflectionException|ImpulseException $e) {
    echo "Erreur Impulse : " . $e->getMessage();
    exit(1);
}
