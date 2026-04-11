<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Vehicle;
use Cycle\ORM\EntityManager;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\RepositoryInterface;
use Cycle\ORM\Select;
use Impulse\Core\App;

/**
 * @implements RepositoryInterface<Vehicle>
 */
final class VehicleRepository implements RepositoryInterface
{
    private ?ORMInterface $orm;

    public function __construct(
        ?ORMInterface $orm = null,
        private readonly string $role = Vehicle::class,
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

    /**
     * @return list<Vehicle>
     */
    public function findByUserId(int $userId): array
    {
        $vehicles = $this->select()->where(['userId' => $userId])->fetchAll();

        usort($vehicles, static function (Vehicle $left, Vehicle $right): int {
            if ($left->isActive() !== $right->isActive()) {
                return $left->isActive() ? -1 : 1;
            }

            return $right->getAcquiredAt() <=> $left->getAcquiredAt();
        });

        return array_values($vehicles);
    }

    public function findByIdForUser(int $id, int $userId): ?Vehicle
    {
        $vehicle = $this->findOne([
            'id' => $id,
            'userId' => $userId,
        ]);

        return $vehicle instanceof Vehicle ? $vehicle : null;
    }

    public function save(Vehicle $vehicle): Vehicle
    {
        if ($vehicle->getCreatedAt() === null) {
            $vehicle->setCreatedAt(null);
        }

        $vehicle->setUpdatedAt(new \DateTimeImmutable());

        $entityManager = new EntityManager($this->orm());
        $entityManager->persist($vehicle);
        $entityManager->run();

        return $vehicle;
    }

    public function delete(Vehicle $vehicle): void
    {
        $entityManager = new EntityManager($this->orm());
        $entityManager->delete($vehicle);
        $entityManager->run();
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
