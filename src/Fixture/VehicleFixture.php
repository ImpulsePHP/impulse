<?php

declare(strict_types=1);

namespace App\Fixture;

use App\Entity\User;
use App\Entity\Vehicle;
use Impulse\Fixtures\AbstractFixture;
use Impulse\Fixtures\FixtureContext;

final class VehicleFixture extends AbstractFixture
{
    public function dependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }

    public function load(FixtureContext $context): void
    {
        /** @var User $admin */
        $admin = $context->requireReference('user.admin');
        /** @var User $demo */
        $demo = $context->requireReference('user.demo');
        /** @var User $garage */
        $garage = $context->requireReference('user.garage');

        $vehicles = [
            $this->makeVehicle(
                user: $admin,
                brand: 'Tesla',
                model: 'Model Y',
                trim: 'Long Range',
                registrationPlate: 'AA-101-EV',
                acquiredAt: new \DateTimeImmutable('-380 days'),
                purchaseCondition: 'new',
                powertrain: 'electric',
                year: 2024,
                odometerKm: 28450,
                batteryCapacityKwh: 75.0,
                averageConsumptionKwh: 16.9,
                rangeKm: 470,
                nextServiceAt: new \DateTimeImmutable('+40 days'),
                isActive: true,
            ),
            $this->makeVehicle(
                user: $admin,
                brand: 'Peugeot',
                model: 'e-208',
                trim: 'GT',
                registrationPlate: 'AA-208-EV',
                acquiredAt: new \DateTimeImmutable('-820 days'),
                purchaseCondition: 'used',
                powertrain: 'electric',
                year: 2021,
                odometerKm: 51200,
                batteryCapacityKwh: 50.0,
                averageConsumptionKwh: 15.8,
                rangeKm: 340,
                nextServiceAt: new \DateTimeImmutable('+15 days'),
                isActive: false,
            ),
            $this->makeVehicle(
                user: $demo,
                brand: 'Renault',
                model: 'Megane E-Tech',
                trim: 'Techno',
                registrationPlate: 'BB-404-FR',
                acquiredAt: new \DateTimeImmutable('-210 days'),
                purchaseCondition: 'used',
                powertrain: 'electric',
                year: 2023,
                odometerKm: 17820,
                batteryCapacityKwh: 60.0,
                averageConsumptionKwh: 17.6,
                rangeKm: 390,
                nextServiceAt: new \DateTimeImmutable('+70 days'),
                isActive: true,
            ),
            $this->makeVehicle(
                user: $garage,
                brand: 'BMW',
                model: 'X1',
                trim: 'xDrive30e',
                registrationPlate: 'CC-301-PH',
                acquiredAt: new \DateTimeImmutable('-145 days'),
                purchaseCondition: 'used',
                powertrain: 'phev',
                year: 2022,
                odometerKm: 22340,
                batteryCapacityKwh: 14.2,
                averageConsumptionKwh: 21.3,
                rangeKm: 72,
                nextServiceAt: new \DateTimeImmutable('+25 days'),
                isActive: true,
            ),
        ];

        foreach ($vehicles as $vehicle) {
            $context->persist($vehicle);
        }

        $context->setReference('vehicles', $vehicles);
    }

    private function makeVehicle(
        User $user,
        string $brand,
        string $model,
        ?string $trim,
        string $registrationPlate,
        \DateTimeImmutable $acquiredAt,
        string $purchaseCondition,
        string $powertrain,
        ?int $year,
        int $odometerKm,
        ?float $batteryCapacityKwh,
        ?float $averageConsumptionKwh,
        ?int $rangeKm,
        ?\DateTimeImmutable $nextServiceAt,
        bool $isActive,
    ): Vehicle {
        $createdAt = $acquiredAt->modify('+1 hour');

        return (new Vehicle())
            ->setUserId((int) $user->getId())
            ->setBrand($brand)
            ->setModel($model)
            ->setTrim($trim)
            ->setRegistrationPlate($registrationPlate)
            ->setAcquiredAt($acquiredAt)
            ->setPurchaseCondition($purchaseCondition)
            ->setPowertrain($powertrain)
            ->setYear($year)
            ->setOdometerKm($odometerKm)
            ->setBatteryCapacityKwh($batteryCapacityKwh)
            ->setAverageConsumptionKwh($averageConsumptionKwh)
            ->setRangeKm($rangeKm)
            ->setNextServiceAt($nextServiceAt)
            ->setIsActive($isActive)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($createdAt);
    }
}
