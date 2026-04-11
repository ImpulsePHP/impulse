<?php

declare(strict_types=1);

namespace App\Policy;

use App\Entity\User;
use App\Entity\Vehicle;

final class VehiclePolicy
{
    public function view(?object $user, Vehicle $vehicle): bool
    {
        if (!$user instanceof User) {
            return false;
        }

        return $this->isAdmin($user)
            || $this->isFleetManager($user)
            || $user->getId() === $vehicle->getUserId();
    }

    public function update(?object $user, Vehicle $vehicle): bool
    {
        if (!$user instanceof User) {
            return false;
        }

        return $this->isAdmin($user)
            || $this->isFleetManager($user)
            || $user->getId() === $vehicle->getUserId();
    }

    public function delete(?object $user, Vehicle $vehicle): bool
    {
        if (!$user instanceof User) {
            return false;
        }

        return $this->isAdmin($user)
            || $user->getId() === $vehicle->getUserId();
    }

    private function isAdmin(User $user): bool
    {
        return in_array('ROLE_ADMIN', $user->getRoles(), true);
    }

    private function isFleetManager(User $user): bool
    {
        return in_array('ROLE_FLEET_MANAGER', $user->getRoles(), true)
            || $this->isAdmin($user);
    }
}
