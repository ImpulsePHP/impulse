<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Cycle\ORM\EntityManager;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\RepositoryInterface;
use Cycle\ORM\Select;
use Impulse\Core\App;

/**
 * @implements RepositoryInterface<User>
 */
final class UserRepository implements RepositoryInterface
{
    private ?ORMInterface $orm;

    public function __construct(
        ?ORMInterface $orm = null,
        private readonly string $role = User::class,
    ) {
        $this->orm = $orm;
    }

    public function findByPK(mixed $id): ?object
    {
        return $this->select()->wherePK($id)->fetchOne();
    }

    public function findOne(array $scope = []): ?object
    {
        return $this->select()->fetchOne($scope);
    }

    public function findAll(array $scope = []): iterable
    {
        return $this->select()->where($scope)->fetchAll();
    }

    public function findByIdentifier(string $email): ?User
    {
        $user = $this->findByEmail($email);

        return $user instanceof User ? $user : null;
    }

    public function findByEmail(string $email): ?User
    {
        $user = $this->findOne(['email' => $email]);

        return $user instanceof User ? $user : null;
    }

    public function existsByEmail(string $email): bool
    {
        return $this->findByEmail($email) instanceof User;
    }

    public function register(string $email, string $plainPassword, array $roles = ['ROLE_USER']): User
    {
        $user = (new User())
            ->setEmail($email)
            ->setPassword(password_hash($plainPassword, PASSWORD_DEFAULT))
            ->setRoles($roles)
            ->setCreatedAt(null)
            ->setUpdatedAt(new \DateTimeImmutable());

        return $this->save($user);
    }

    public function save(User $user): User
    {
        if ($user->getCreatedAt() === null) {
            $user->setCreatedAt(null);
        }

        $user->setUpdatedAt(new \DateTimeImmutable());

        $entityManager = new EntityManager($this->orm());
        $entityManager->persist($user);
        $entityManager->run();

        return $user;
    }

    private function select(): Select
    {
        return new Select($this->orm(), $this->role);
    }

    private function orm(): ORMInterface
    {
        return $this->orm ??= App::get(ORMInterface::class);
    }
}
