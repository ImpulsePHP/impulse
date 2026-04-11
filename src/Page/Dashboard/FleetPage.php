<?php

declare(strict_types=1);

namespace App\Page\Dashboard;

use Impulse\Acl\Middleware\AuthorizeMiddleware;
use Impulse\Auth\Middleware\RequireAuthMiddleware;
use Impulse\Core\Attributes\PageProperty;
use Impulse\Core\Component\AbstractPage;

#[PageProperty(
    route: '/dashboard/fleet',
    name: 'FleetDashboardPage',
    title: 'Pilotage du parc',
    middlewares: [
        RequireAuthMiddleware::class,
        AuthorizeMiddleware::class,
    ]
)]
final class FleetPage extends AbstractPage
{
    public function template(): string
    {
        return $this->view('pages.dashboard.fleet');
    }
}
