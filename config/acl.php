<?php

declare(strict_types=1);

use App\Entity\User;

return [
    'abilities' => [
        'dashboard.access' => static function (?object $user): bool {
            return $user instanceof User
                && array_intersect($user->getRoles(), ['ROLE_USER', 'ROLE_FLEET_MANAGER', 'ROLE_ADMIN']) !== [];
        },
        'fleet.manage' => static function (?object $user): bool {
            return $user instanceof User
                && array_intersect($user->getRoles(), ['ROLE_FLEET_MANAGER', 'ROLE_ADMIN']) !== [];
        },
        'admin.access' => static function (?object $user): bool {
            return $user instanceof User
                && in_array('ROLE_ADMIN', $user->getRoles(), true);
        },
    ],
    'zones' => [
        '/dashboard' => 'dashboard.access',
        '/dashboard/fleet' => 'fleet.manage',
        '/dashboard/admin' => 'admin.access',
    ],
    'role_hierarchy' => [
        'ROLE_ADMIN' => ['ROLE_FLEET_MANAGER'],
        'ROLE_FLEET_MANAGER' => ['ROLE_USER'],
    ],
    'messages' => [
        'forbidden' => 'Vous n’avez pas les droits nécessaires pour accéder à cette ressource.',
        'flash_key' => 'error',
    ],
];
