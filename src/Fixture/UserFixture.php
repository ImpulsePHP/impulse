<?php

declare(strict_types=1);

namespace App\Fixture;

use App\Entity\User;
use Impulse\Fixtures\AbstractFixture;
use Impulse\Fixtures\FixtureContext;

final class UserFixture extends AbstractFixture
{
    public function load(FixtureContext $context): void
    {
        $database = $context->db()->getDatabase();
        $database->execute('DELETE FROM vehicles');
        $database->execute('DELETE FROM users');

        $now = new \DateTimeImmutable();
        $users = [
            'admin' => $this->makeUser(
                email: 'admin@impulse.test',
                plainPassword: 'password',
                roles: ['ROLE_ADMIN'],
                createdAt: $now->modify('-45 days'),
            ),
            'demo' => $this->makeUser(
                email: 'demo@impulse.test',
                plainPassword: 'password',
                roles: ['ROLE_USER'],
                createdAt: $now->modify('-20 days'),
            ),
            'garage' => $this->makeUser(
                email: 'garage@impulse.test',
                plainPassword: 'password',
                roles: ['ROLE_USER'],
                createdAt: $now->modify('-8 days'),
            ),
        ];

        foreach ($users as $key => $user) {
            $context->persist($user);
            $context->setReference('user.' . $key, $user);
        }

        $context->setReference('users', array_values($users));
    }

    private function makeUser(
        string $email,
        string $plainPassword,
        array $roles,
        \DateTimeImmutable $createdAt,
    ): User {
        return (new User())
            ->setEmail($email)
            ->setPassword(password_hash($plainPassword, PASSWORD_DEFAULT))
            ->setRoles($roles)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($createdAt);
    }
}
