<?php

declare(strict_types=1);

namespace App\Component\Dashboard;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Impulse\Auth\Contracts\AuthInterface;
use Impulse\Acl\Trait\AuthorizesRequests;
use Impulse\Core\App;
use Impulse\Core\Component\AbstractComponent;
use JsonException;
use ReflectionException;

final class VehiclesComponent extends AbstractComponent
{
    use AuthorizesRequests;

    private const VIEW_NUMBER_VEHICLES = 10;

    public ?string $tagName = 'dashboard-vehicles';

    private AuthInterface $auth;
    private VehicleRepository $vehicleRepository;

    /**
     * @throws ReflectionException
     */
    public function boot(): void
    {
        $this->auth = App::get(AuthInterface::class);
        $this->vehicleRepository = new VehicleRepository();
    }

    /**
     * @throws JsonException
     * @throws ReflectionException
     */
    public function template(): string
    {
        $vehiclesRaw = $this->can('fleet.manage')
            ? $this->vehicleRepository->findAll()
            : $this->vehicleRepository->findByUserId((int) $this->auth->id());

        $vehicles = array_values(array_filter(
            is_array($vehiclesRaw) ? $vehiclesRaw : iterator_to_array($vehiclesRaw),
            fn (mixed $vehicle): bool => $vehicle instanceof Vehicle && $this->can('view', $vehicle),
        ));

        $columns = $this->getColumns();
        $rows = $this->getRows($vehicles);
        $actions = $this->getActions($vehicles);

        $nbVehicles = self::VIEW_NUMBER_VEHICLES;
        $pagination = count($vehicles) > $nbVehicles;

        return <<<HTML
            <uidata-table
                columns="$columns"
                rows="$rows"
                row-actions="$actions"
                show-pagination="$pagination"
                per-page="$nbVehicles"
                actions-mode="dropdown"
            />
        HTML;
    }

    /**
     * @throws JsonException
     */
    private function getColumns(): string
    {
        $columns = json_encode([
            ["key" => "brand", "label" => "Marque"],
            ["key" => "model", "label" => "Modèle"],
            ["key" => "year", "label" => "Année"],
            ["key" => "owner", "label" => "Accès"],
        ], JSON_THROW_ON_ERROR);

        return htmlspecialchars($columns, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * @throws JsonException
     */
    private function getRows(array $vehicles): string
    {
        $rows = json_encode(array_map(
            fn (Vehicle $vehicle): array => [
                'id' => $vehicle->getId(),
                'brand' => $vehicle->getBrand(),
                'model' => $vehicle->getModel(),
                'year' => [
                    'component' => 'uibadge',
                    'props' => ['color' => 'green'],
                    'slot' => $vehicle->getYear() ?? '—'
                ],
                'owner' => [
                    'component' => 'uibadge',
                    'props' => [
                        'color' => $vehicle->getUserId() === (int) $this->auth->id() ? 'green' : 'pink',
                    ],
                    'slot' => $vehicle->getUserId() === (int) $this->auth->id() ? 'Personnel' : 'Supervisé',
                ]
            ],
            $vehicles,
        ), JSON_THROW_ON_ERROR);

        return htmlspecialchars($rows, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * @throws ReflectionException
     * @throws JsonException
     */
    private function getActions(array $vehicles): string
    {
        $actions = [];

        if ($vehicles !== []) {
            $actions[] = ["name" => "view", "label" => "Voir", "icon" => "eye"];

            if ($this->allVehiclesAllowed($vehicles, 'update')) {
                $actions[] = ["name" => "edit", "label" => "Modifier", "icon" => "pencil-square", "color" => "indigo"];
            }

            if ($this->allVehiclesAllowed($vehicles, 'delete')) {
                $actions[] = ["name" => "delete", "label" => "Supprimer", "icon" => "trash", "color" => "red"];
            }
        }

        $actionsJson = json_encode($actions, JSON_THROW_ON_ERROR);

        return htmlspecialchars($actionsJson, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * @param list<Vehicle> $vehicles
     * @throws ReflectionException
     */
    private function allVehiclesAllowed(array $vehicles, string $ability): bool
    {
        foreach ($vehicles as $vehicle) {
            if (!$this->can($ability, $vehicle)) {
                return false;
            }
        }

        return true;
    }
}
