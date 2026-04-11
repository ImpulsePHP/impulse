<?php

declare(strict_types=1);

namespace App\Component\Dashboard;

use App\Repository\VehicleRepository;
use Impulse\Auth\Contracts\AuthInterface;
use Impulse\Core\App;
use Impulse\Core\Component\AbstractComponent;
use ReflectionException;

final class VehiclesComponent extends AbstractComponent
{
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
            ["key" => "year", "label" => "Année"]
        ], JSON_THROW_ON_ERROR);

        $vehiclesRaw = $this->vehicleRepository->findByUserId($this->auth->id());
        $rows = json_encode($vehiclesRaw, JSON_THROW_ON_ERROR);

        $actions = json_encode([
            ["name" => "view", "label" => "View", "icon" => "eye"],
            ["name" => "edit", "label" => "Edit", "icon" => "pencil-square", "color" => "indigo"],
            ["name" => "delete", "label" => "Delete", "icon" => "trash", "color" => "red"]
        ], JSON_THROW_ON_ERROR);

        $nbVehicles = self::NUMBER_VEHICLES;
        $pagination = count($vehiclesRaw) > $nbVehicles;

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
}
