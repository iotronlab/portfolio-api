<?php

namespace App\Orchid\Screens\Portfolio;

use Orchid\Screen\Screen;

class PortfolioEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PortfolioEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'PortfolioEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
