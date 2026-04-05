<?php

declare(strict_types=1);

namespace App\Layout\Default;

use Impulse\Core\Component\AbstractLayout;
use Impulse\Core\Support\Collector\StyleCollector;

final class DefaultLayout extends AbstractLayout
{
    public function setup(): void
    {
        StyleCollector::addSheet('/css/main.css');
    }

    public function template(): string
    {
        return $this->view('layouts.default',  [
            'slot' => $this->slot()
        ]);
    }
}
