<?php

declare(strict_types=1);

namespace App\Page;

use Impulse\Core\Attributes\PageProperty;
use Impulse\Core\Component\AbstractPage;

#[PageProperty(
    route: '/register',
    name: 'RegisterPage',
    title: 'Ouvrir un nouveau compte'
)]
final class RegisterPage extends AbstractPage
{
    public function template(): string
    {
        return $this->view('pages.register');
    }
}
