<?php

namespace App\Orchid\Screens;

use App\Models\Interns;
use App\Orchid\Layouts\InternListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class InternListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'InternListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'InternListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'interns' => Interns::paginate()
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
                ->route('platform.intern.edit')
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
            InternListLayout::class
        ];
    }
}
