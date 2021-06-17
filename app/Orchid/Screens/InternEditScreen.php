<?php

namespace App\Orchid\Screens;

use App\Models\Interns;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Orchid\Alert\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert as FacadesAlert;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\ModalToggle;
use SebastianBergmann\CodeCoverage\Report\Xml\Facade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Interns $intern): array
    {
        $this->exists = $intern->exists;

        if ($this->exists) {
            $this->name = 'Edit Intern';
            $this->description = 'Edit Intern';
        }

        return [
            'intern' => $intern,
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
            ]),
            Layout::modal('exampleModal', [
                Layout::rows([]),
            ]),
        ];
    }

    /**
     * @param Interns    $intern
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createOrUpdate(Interns $intern, Request $request)
    {
        $data = $request->get('intern');
        //   $data['uid'] = (string) Str::uuid();
        // dd($data);
        $intern->fill($data)->save();

        FacadesAlert::info('You have successfully created an intern.');

        return redirect()->route('platform.intern.list');
    }

    public function qrgenerate(Interns $intern)
    {

        // if ($intern->qr_path != null) {
        //     return Storage::download($intern->qr_path);
        // }
        QrCode::size(800)
            ->format('svg')
            ->generate('https://cert.iotronlabs.com/intern/' . $intern->uid, '../public/storage/qrcodes/' . $intern->uid . '.svg');
        // if (Storage::disk('public')->exists('qrcodes/' . $intern->uid . '.svg')) {
        //     dd($intern);
        // }
        //   $intern->setAttribute('Qrcode', 'images/qrcode' . $intern->uid . '.svg');
        $path = public_path('storage/qrcodes/' . $intern->uid . '.svg');

        $file = Storage::disk('public')->get('qrcodes/' . $intern->uid . '.svg');
        $intern->update([
            'qr_path' => $path
            //  asset('storage/qrcodes/' . $intern->uid . '.svg')
        ]);
        $headers = [

            'Content-Type' =>  'image/svg',

        ];
        return (new Response($file, 200))
            ->header('Content-Type', 'image/svg');
        //FacadesAlert::info('Done');
    }


    /**
     * @param Interns $intern
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Interns $intern)
    {
        $intern->delete();
        FacadesAlert::info('You have successfully deleted the intern.');

        return redirect()->route('platform.intern.list');
    }
}
