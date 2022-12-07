<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationCategoryRequest;
use App\Http\Requests\UpdateDestinationCategoryRequest;

class DestinationCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreDestinationCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestinationCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DestinationCategory  $destinationCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DestinationCategory $destinationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DestinationCategory  $destinationCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DestinationCategory $destinationCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDestinationCategoryRequest  $request
     * @param  \App\Models\DestinationCategory  $destinationCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestinationCategoryRequest $request, DestinationCategory $destinationCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DestinationCategory  $destinationCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestinationCategory $destinationCategory)
    {
        //
    }
}
