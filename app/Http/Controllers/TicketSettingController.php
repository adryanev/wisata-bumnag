<?php

namespace App\Http\Controllers;

use App\Models\TicketSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketSettingRequest;
use App\Http\Requests\UpdateTicketSettingRequest;

class TicketSettingController extends Controller
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
     * @param  \App\Http\Requests\StoreTicketSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketSetting  $ticketSetting
     * @return \Illuminate\Http\Response
     */
    public function show(TicketSetting $ticketSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketSetting  $ticketSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketSetting $ticketSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketSettingRequest  $request
     * @param  \App\Models\TicketSetting  $ticketSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketSettingRequest $request, TicketSetting $ticketSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketSetting  $ticketSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketSetting $ticketSetting)
    {
        //
    }
}
