<?php

declare(strict_types=1);

namespace App\Middleware;

use Impulse\Auth\Contracts\AuthInterface;
use Impulse\Core\Contracts\MiddlewareInterface;
use Impulse\Core\Http\Request;
use Impulse\Core\Http\Response;

final readonly class CheckAuthMiddleware implements MiddlewareInterface
{
    public function __construct(
        private AuthInterface $auth,
    ) {
    }

    public function handle(Request $request, callable $next): Response
    {
        if ($this->auth->check()) {
            return Response::redirectToPage('DashboardPage');
        }

        return $next($request);
    }
}
