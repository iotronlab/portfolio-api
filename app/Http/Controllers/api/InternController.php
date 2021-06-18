<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Intern;

use Illuminate\Http\Request;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interns  $interns
     * @return \Illuminate\Http\Response
     */
    public function show(Intern $intern)
    {
        return $intern;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interns  $interns
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interns  $interns
     * @return \Illuminate\Http\Response
     */
}
