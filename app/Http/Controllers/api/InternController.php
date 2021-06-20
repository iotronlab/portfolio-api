<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InternResource;
use App\Models\Intern;

use Illuminate\Http\Request;

class InternController extends Controller
{
    public function show(Intern $intern)
    {
        return new InternResource($intern);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interns  $interns
     * @return \Illuminate\Http\Response
     */
    public function getQR(Intern $intern)
    {
        return response()->download(storage_path('app/public/qrcodes/' . $intern->uid . '.svg'));
    }
}
