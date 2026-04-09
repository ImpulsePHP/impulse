<?php

declare(strict_types=1);

namespace App\Component\Dashboard;

use Impulse\Auth\Contracts\AuthInterface;
use Impulse\Core\App;
use Impulse\Core\Attributes\Action;
use Impulse\Core\Component\AbstractComponent;
use Impulse\Core\Http\Response;

final class HeaderComponent extends AbstractComponent
{
    public ?string $tagName = 'dashboard-header';

    private AuthInterface $auth;

    /**
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        $this->auth = App::get(AuthInterface::class);
    }

    #[Action]
    public function logout(): Response
    {
        $this->auth->logout();
        return Response::redirectToPage('IndexPage');
    }

    public function template(): string
    {
        $username = $this->auth->user()->getEmail();

        return <<<HTML
            <div class="w-full mx-auto p-6">
                <h1 class="text-2xl font-medium">Dashboard</h1>
                <p class="text-lg">Bienvenue, $username !</p>
                <p class="text-rose-700 mt-8 cursor-pointer" data-action-click="logout">
                    Déconnexion
                </p>
            </div>
        HTML;
    }
}
