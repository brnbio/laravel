<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Class PageTitle
 *
 * @package App\View\Components
 */
class PageTitle extends Component
{
    /**
     * @return string
     */
    public function render(): string
    {
        return <<<'blade'
            <div class="content">
                <h1 class="page-title">{{ $slot }}</h1>
            </div>
        blade;
    }
}
