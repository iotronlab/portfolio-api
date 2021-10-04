<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;

class PortfolioListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Portfolio List';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all your works';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $portfolio = Portfolio::all();
        return [
            'portfolio' => $portfolio
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.portfolio.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table(
                'portfolio',
                [
                    TD::make('name')
                ]

            )
        ];
    }
}
