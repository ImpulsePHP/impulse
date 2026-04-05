<?php

use App\Layout\Default\DefaultLayout;

return [
    'app_name' => 'Mon projet Impulse',
    'env' => 'dev',
    'debug' => true,
    'logs' => [
        'enabled' => true,
    ],
    'state_encryption_key' => base64_encode(random_bytes(32)),
    'template_engine' => 'blade',
    'template_path' => 'views',
    'template_layout' => DefaultLayout::class,
    'middlewares' => [],
    'providers' => [
        Impulse\Database\DatabaseProvider::class,
        Impulse\Translation\TranslatorProvider::class,
    ],
    'locale' => 'fr',
    'supported' => ['fr', 'en'],
    'cache' => [
        'enabled' => false,
        'ttl' => 600,
    ],
];
