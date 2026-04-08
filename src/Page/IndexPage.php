<?php

declare(strict_types=1);

namespace App\Page;

use Impulse\Core\Attributes\PageProperty;
use Impulse\Core\Component\AbstractPage;

#[PageProperty(
    route: '/',
    name: 'IndexPage',
    title: 'Se connecter'
)]
final class IndexPage extends AbstractPage
{
    public function template(): string
    {
        return $this->view('pages.index');
    }
}
