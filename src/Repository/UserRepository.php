<?php

namespace App\Repository;

use App\Entity\User;
use Cycle\ORM\EntityManager;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\RepositoryInterface;
use Impulse\Auth\Contracts\UserRepositoryInterface;
use Impulse\Auth\Domain\User as AuthUser;
use Impulse\Database\Contrats\DatabaseInterface;

final class UserRepository implements UserRepositoryInterface
{
    private ?RepositoryInterface $repository;
    private ?ORMInterface $orm;

    public function __construct(private readonly DatabaseInterface $database)
    {
        $this->orm = $this->database->getORM();
        $this->repository = $this->orm->getRepository(User::class);
    }

    public function findByIdentifier(string $identifier): ?object
    {
        $entity = $this->repository->findOne(['email' => $identifier]);
        if (!$entity) {
            return null;
        }

        return $this->toAuthUserFromEntity($entity);
    }

    public function findById(int|string $id): ?object
    {
        $entity = $this->repository->findByPK($id);
        if (!$entity) {
            return null;
        }

        return $this->toAuthUserFromEntity($entity);
    }

    /**
     * @throws \Throwable
     */
    public function save(object $entity): void
    {
        if (!$entity instanceof User) {
            throw new \DomainException('L\'objet fournis doit être de type '. User::class);
        }

        $manager = new EntityManager($this->orm);
        $manager->persist($entity);
        $manager->run();
    }

    private function toAuthUserFromEntity(object $entity): AuthUser
    {
        $id = method_exists($entity, 'getId') ? $entity->getId() : ($entity->id ?? null);
        $email = method_exists($entity, 'getEmail') ? $entity->getEmail() : ($entity->email ?? null);
        $password = method_exists($entity, 'getPassword') ? $entity->getPassword() : ($entity->password ?? null);

        return new AuthUser(
            id: $id,
            email: $email ?? '',
            passwordHash: $password ?? '',
            roles: []
        );
    }
}
