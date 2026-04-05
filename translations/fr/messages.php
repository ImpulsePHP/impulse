<?php

return [
    'layout' => [
        'project' => 'Projet ImpulsePHP',
        'subtitle' => 'Un projet minimal prêt à l\'emploi basé sur ImpulsePHP',
        'nav' => [
            'github' => 'GitHub',
        ],
        'footer' => [
            'made_with' => 'ImpulsePHP',
            'serve_note' => 'Les fichiers publics sont servis depuis /public. Exécutez {cmd} pour tester en local.',
        ],
    ],

    'page' => [
        'title' => '👋 Bienvenue sur le projet de démarrage ImpulsePHP',
        'description' => 'Ceci est une petite application prête à l\'emploi que vous pouvez cloner et étendre. Elle démontre un layout minimal, des assets publics et comment exécuter l\'application en local.',
        'quick_start' => 'Démarrage rapide',
        'commands' => "git clone <repo-url> mon-projet\ncd mon-projet\ncomposer install\nnpm install # optionnel, pour Tailwind CSS\nnpm run watch:css # optionnel, pour générer/surveiller css\n\nphp -S localhost:8000 -t public",
        'what_you_find' => 'Ce que vous trouverez',
        'what_public_title' => '/public',
        'what_public' => '— front controller et assets publics',
        'what_views_title' => '/views',
        'what_views' => '— templates de type Blade (layouts et pages)',
        'what_src_title' => '/src',
        'what_src' => '— code applicatif PHP (pages / contrôleurs)',
        'runtime_note' => 'Si les packages sont présents via Composer, le runtime JS sera lié vers /impulse.js automatiquement via le script post-install.',
    ],
];

