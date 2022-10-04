<?php

namespace App\Http\Controllers;

use App\Models\AdBanner;
use App\Http\Requests\StoreAdBannerRequest;
use App\Http\Requests\UpdateAdBannerRequest;

class AdBannerController extends Controller
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
     * @param  \App\Http\Requests\StoreAdBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdBannerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function show(AdBanner $adBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(AdBanner $adBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdBannerRequest  $request
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdBannerRequest $request, AdBanner $adBanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdBanner $adBanner)
    {
        //
    }
}
