<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\VehicleRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(repository: VehicleRepository::class, table: 'vehicles')]
class Vehicle
{
    #[Column(type: 'primary')]
    private ?int $id = null;

    #[Column(type: 'integer')]
    private int $userId;

    #[Column(type: 'string')]
    private string $brand;

    #[Column(type: 'string')]
    private string $model;

    #[Column(type: 'string', nullable: true)]
    private ?string $trim = null;

    #[Column(type: 'string')]
    private string $registrationPlate;

    #[Column(type: 'datetime')]
    private \DateTimeImmutable $acquiredAt;

    #[Column(type: 'string')]
    private string $purchaseCondition;

    #[Column(type: 'string')]
    private string $powertrain;

    #[Column(type: 'integer', nullable: true)]
    private ?int $year = null;

    #[Column(type: 'integer')]
    private int $odometerKm = 0;

    #[Column(type: 'float', nullable: true)]
    private ?float $batteryCapacityKwh = null;

    #[Column(type: 'float', nullable: true)]
    private ?float $averageConsumptionKwh = null;

    #[Column(type: 'integer', nullable: true)]
    private ?int $rangeKm = null;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $nextServiceAt = null;

    #[Column(type: 'integer')]
    private int $isActive = 1;

    #[Column(type: 'datetime')]
    private ?\DateTimeImmutable $createdAt = null;

    #[Column(type: 'datetime')]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getTrim(): ?string
    {
        return $this->trim;
    }

    public function setTrim(?string $trim): self
    {
        $this->trim = $trim;

        return $this;
    }

    public function getRegistrationPlate(): string
    {
        return $this->registrationPlate;
    }

    public function setRegistrationPlate(string $registrationPlate): self
    {
        $this->registrationPlate = $registrationPlate;

        return $this;
    }

    public function getAcquiredAt(): \DateTimeImmutable
    {
        return $this->acquiredAt;
    }

    public function setAcquiredAt(\DateTimeImmutable $acquiredAt): self
    {
        $this->acquiredAt = $acquiredAt;

        return $this;
    }

    public function getPurchaseCondition(): string
    {
        return $this->purchaseCondition;
    }

    public function setPurchaseCondition(string $purchaseCondition): self
    {
        $this->purchaseCondition = $purchaseCondition;

        return $this;
    }

    public function getPowertrain(): string
    {
        return $this->powertrain;
    }

    public function setPowertrain(string $powertrain): self
    {
        $this->powertrain = $powertrain;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getOdometerKm(): int
    {
        return $this->odometerKm;
    }

    public function setOdometerKm(int $odometerKm): self
    {
        $this->odometerKm = $odometerKm;

        return $this;
    }

    public function getBatteryCapacityKwh(): ?float
    {
        return $this->batteryCapacityKwh;
    }

    public function setBatteryCapacityKwh(?float $batteryCapacityKwh): self
    {
        $this->batteryCapacityKwh = $batteryCapacityKwh;

        return $this;
    }

    public function getAverageConsumptionKwh(): ?float
    {
        return $this->averageConsumptionKwh;
    }

    public function setAverageConsumptionKwh(?float $averageConsumptionKwh): self
    {
        $this->averageConsumptionKwh = $averageConsumptionKwh;

        return $this;
    }

    public function getRangeKm(): ?int
    {
        return $this->rangeKm;
    }

    public function setRangeKm(?int $rangeKm): self
    {
        $this->rangeKm = $rangeKm;

        return $this;
    }

    public function getNextServiceAt(): ?\DateTimeImmutable
    {
        return $this->nextServiceAt;
    }

    public function setNextServiceAt(?\DateTimeImmutable $nextServiceAt): self
    {
        $this->nextServiceAt = $nextServiceAt;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive === 1;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive ? 1 : 0;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        if ($createdAt === null) {
            $this->createdAt = new \DateTimeImmutable();

            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
