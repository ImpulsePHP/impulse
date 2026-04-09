<?php

declare(strict_types=1);

namespace App\Page\Dashboard;

use Impulse\Auth\Middleware\RequireAuthMiddleware;
use Impulse\Core\Attributes\PageProperty;
use Impulse\Core\Component\AbstractPage;

#[PageProperty(
    route: '/dashboard',
    name: 'DashboardPage',
    title: 'Dashboard',
    middlewares: [
        RequireAuthMiddleware::class
    ]
)]
final class IndexPage extends AbstractPage
{
    public function template(): string
    {
        return $this->view('pages.dashboard.index');
    }
}
