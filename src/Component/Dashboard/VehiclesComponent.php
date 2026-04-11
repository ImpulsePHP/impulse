<?php

declare(strict_types=1);

namespace App\Component\Dashboard;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Impulse\Auth\Contracts\AuthInterface;
use Impulse\Acl\Trait\AuthorizesRequests;
use Impulse\Core\App;
use Impulse\Core\Component\AbstractComponent;
use ReflectionException;

final class VehiclesComponent extends AbstractComponent
{
    use AuthorizesRequests;

    private const NUMBER_VEHICLES = 10;

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

    public function setup(): void
    {
        $this->states([

        ]);
    }

    /**
     * @throws \JsonException
     */
    public function template(): string
    {
        $columns = json_encode([
            ["key" => "brand", "label" => "Marque"],
            ["key" => "model", "label" => "Modèle"],
            ["key" => "year", "label" => "Année"],
            ["key" => "owner", "label" => "Accès"],
        ], JSON_THROW_ON_ERROR);

        $vehiclesRaw = $this->can('fleet.manage')
            ? $this->vehicleRepository->findAll()
            : $this->vehicleRepository->findByUserId((int) $this->auth->id());

        $vehicles = array_values(array_filter(
            is_array($vehiclesRaw) ? $vehiclesRaw : iterator_to_array($vehiclesRaw),
            fn (mixed $vehicle): bool => $vehicle instanceof Vehicle && $this->can('view', $vehicle),
        ));

        $rows = json_encode(array_map(
            fn (Vehicle $vehicle): array => [
                'id' => $vehicle->getId(),
                'brand' => $vehicle->getBrand(),
                'model' => $vehicle->getModel(),
                'year' => $vehicle->getYear() ?? '—',
                'owner' => $vehicle->getUserId() === (int) $this->auth->id() ? 'Personnel' : 'Supervisé',
            ],
            $vehicles,
        ), JSON_THROW_ON_ERROR);

        $actions = [];
        if ($vehicles !== []) {
            $canUpdateAll = $this->allVehiclesAllowed($vehicles, 'update');
            $canDeleteAll = $this->allVehiclesAllowed($vehicles, 'delete');

            $actions[] = ["name" => "view", "label" => "Voir", "icon" => "eye"];

            if ($canUpdateAll) {
                $actions[] = ["name" => "edit", "label" => "Modifier", "icon" => "pencil-square", "color" => "indigo"];
            }

            if ($canDeleteAll) {
                $actions[] = ["name" => "delete", "label" => "Supprimer", "icon" => "trash", "color" => "red"];
            }
        }

        $actions = json_encode($actions, JSON_THROW_ON_ERROR);

        $nbVehicles = self::NUMBER_VEHICLES;
        $pagination = count($vehicles) > $nbVehicles;

        // Échapper les JSON pour les insérer dans des attributs HTML
        $columnsEsc = htmlspecialchars($columns, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $rowsEsc = htmlspecialchars($rows, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $actionsEsc = htmlspecialchars($actions, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $paginationJson = json_encode($pagination, JSON_THROW_ON_ERROR);

        return <<<HTML
            <uidata-table
                columns="$columnsEsc"
                rows="$rowsEsc"
                row-actions="$actionsEsc"
                show-pagination="$paginationJson"
                per-page="$nbVehicles"
                actions-mode="dropdown"
            />
        HTML;
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
