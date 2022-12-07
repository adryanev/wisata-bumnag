<?php

namespace App\Http\Controllers;

use App\Models\DestinationCertification;
use App\Http\Requests\StoreDestinationCertificationRequest;
use App\Http\Requests\UpdateDestinationCertificationRequest;

class DestinationCertificationController extends Controller
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
     * @param  \App\Http\Requests\StoreDestinationCertificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestinationCertificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DestinationCertification  $destinationCertification
     * @return \Illuminate\Http\Response
     */
    public function show(DestinationCertification $destinationCertification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DestinationCertification  $destinationCertification
     * @return \Illuminate\Http\Response
     */
    public function edit(DestinationCertification $destinationCertification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDestinationCertificationRequest  $request
     * @param  \App\Models\DestinationCertification  $destinationCertification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestinationCertificationRequest $request, DestinationCertification $destinationCertification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DestinationCertification  $destinationCertification
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestinationCertification $destinationCertification)
    {
        //
    }
}
