<?php

namespace App\Http\Controllers;

use App\Models\Souvenir;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSouvenirRequest;
use App\Http\Requests\UpdateSouvenirRequest;

class SouvenirController extends Controller
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
     * @param  \App\Http\Requests\StoreSouvenirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSouvenirRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function show(Souvenir $souvenir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function edit(Souvenir $souvenir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSouvenirRequest  $request
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSouvenirRequest $request, Souvenir $souvenir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Souvenir $souvenir)
    {
        //
    }
}
