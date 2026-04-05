<?php

return [
    'layout' => [
        'project' => 'ImpulsePHP Project',
        'subtitle' => 'A minimal starter project based on ImpulsePHP',
        'nav' => [
            'github' => 'GitHub',
        ],
        'footer' => [
            'made_with' => 'ImpulsePHP',
            'serve_note' => 'Public files served from /public. Run {cmd} to test locally.',
        ],
    ],

    'page' => [
        'title' => '👋 Welcome to the ImpulsePHP Starter Project',
        'description' => 'This is a small, ready-to-use example application you can clone and extend. It demonstrates a minimal layout, public assets and how to run the app locally.',
        'quick_start' => 'Quick start',
        'commands' => "git clone <repo-url> my-project\ncd my-project\ncomposer install\nnpm install # optional, for Tailwind CSS\nnpm run watch:css # optional, to build/watch css\n\nphp -S localhost:8000 -t public",
        'what_you_find' => "What you'll find",
        'what_public_title' => '/public',
        'what_public' => '— front controller and served assets',
        'what_views_title' => '/views',
        'what_views' => '— Blade-like templates (layouts and pages)',
        'what_src_title' => '/src',
        'what_src' => '— application PHP code (controllers/pages)',
        'runtime_note' => 'If you have the packages present via Composer, the JS runtime will be linked to /impulse.js automatically via the post-install script.',
    ],
];

