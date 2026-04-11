<?php

declare(strict_types=1);

namespace App\Fixture\Story;

use App\Fixture\UserFixture;
use App\Fixture\VehicleFixture;
use Impulse\Fixtures\AbstractStory;

final class AppDemoStory extends AbstractStory
{
    public function description(): string
    {
        return 'Jeu de donnees de demonstration pour les utilisateurs et leurs vehicules.';
    }

    public function fixtures(): array
    {
        return [
            UserFixture::class,
            VehicleFixture::class,
        ];
    }
}
