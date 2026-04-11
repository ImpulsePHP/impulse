<?php

declare(strict_types=1);

namespace App\Page\Dashboard;

use Impulse\Acl\Middleware\AuthorizeMiddleware;
use Impulse\Auth\Middleware\RequireAuthMiddleware;
use Impulse\Core\Attributes\PageProperty;
use Impulse\Core\Component\AbstractPage;

#[PageProperty(
    route: '/dashboard/admin',
    name: 'AdminDashboardPage',
    title: 'Administration',
    middlewares: [
        RequireAuthMiddleware::class,
        AuthorizeMiddleware::class,
    ]
)]
final class AdminPage extends AbstractPage
{
    public function template(): string
    {
        return $this->view('pages.dashboard.admin');
    }
}
