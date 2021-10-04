<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\api\InternController;
use App\Models\Intern;
use App\Models\Interns;
use App\View\Components\internQR;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Orchid\Alert\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert as FacadesAlert;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use SebastianBergmann\CodeCoverage\Report\Xml\Facade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use \Imagick;

class InternEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Intern Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Add a new intern';
    public $qr_uid = null;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Intern $intern): array
    {
        $this->exists = $intern->exists;

        if ($this->exists) {
            $this->name = 'Edit Intern';
            $this->description = 'Edit Intern';
            $this->qr_uid = $intern->uid;
        }

        return [
            'intern' => $intern
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
            Button::make('Create Intern')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),

            Button::make('Generate Qr-code')
                ->icon('barcode')
                ->method('qrgenerate')
                ->canSee($this->exists),
            // Link::make('Download Qr-code')
            //     ->icon('barcode')
            //     ->canSee($this->exists)
            //     ->route('getQR', $this->uid),
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
            Layout::rows([
                Input::make('intern.uid')
                    ->title('UID')
                    ->placeholder('Enter Unique ID')
                    ->help('Certificate Number'),

                Input::make('intern.name')
                    ->title('Name')
                    ->placeholder('Enter your name')
                    ->help('Specify a name'),

                Input::make('intern.email')
                    ->title('Email address')
                    ->placeholder('Email address')
                    ->help("We'll never share your email with anyone else.")
                    ->popover('Tooltip - hint that user opens himself.'),

                DateTimer::make('intern.start_date')
                    ->title('Start date')
                    ->format('Y-m-d'),

                DateTimer::make('intern.end_date')
                    ->title('End date')
                    ->format('Y-m-d'),

                Input::make('intern.duration')
                    ->title('Duration')
                    ->placeholder('Enter duration'),

                Input::make('intern.projects')
                    ->title('Projects')
                    ->placeholder('Enter projects'),

                Input::make('intern.technology')
                    ->title('Technology')
                    ->placeholder('Enter technology'),
                // Link::make('Download Qr-code')
                //     ->icon('barcode')
                //     ->canSee($this->exists)
                // ->route('getQR', $this->qr_uid),


            ])
        ];
    }

    /**
     * @param Interns    $intern
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createOrUpdate(Intern $intern, Request $request)
    {
        $data = $request->get('intern');

        $intern->fill($data)->save();

        FacadesAlert::info('You have successfully created an intern.');

        return redirect()->route('platform.intern.list');
    }

    public function qrgenerate(Intern $intern)
    {

        QrCode::format('png')
            ->mergeString(Storage::get('public/logo.jpg'), .3)
            ->size(500)->errorCorrection('H')
            ->generate('https://www.iotron.co/verify/' . $intern->uid, '../public/storage/qrcodes/' . $intern->uid . '.png');

        $this->downloadQR($intern);
    }

    public function downloadQR(Intern $intern)
    {
        // dd($intern);
        return response()->streamDownload(storage_path('app/public/qrcodes/' . $intern->uid . '.png'));
    }
    /**
     * @param Interns $intern
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Intern $intern)
    {
        $intern->delete();
        FacadesAlert::info('You have successfully deleted the intern.');

        return redirect()->route('platform.intern.list');
    }
}
