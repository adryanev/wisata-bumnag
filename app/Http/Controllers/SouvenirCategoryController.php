<?php

namespace App\Http\Controllers;

use App\Models\SouvenirCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSouvenirCategoryRequest;
use App\Http\Requests\UpdateSouvenirCategoryRequest;

class SouvenirCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreSouvenirCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSouvenirCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SouvenirCategory  $souvenirCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SouvenirCategory $souvenirCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SouvenirCategory  $souvenirCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SouvenirCategory $souvenirCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSouvenirCategoryRequest  $request
     * @param  \App\Models\SouvenirCategory  $souvenirCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSouvenirCategoryRequest $request, SouvenirCategory $souvenirCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SouvenirCategory  $souvenirCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SouvenirCategory $souvenirCategory)
    {
        //
    }
}
