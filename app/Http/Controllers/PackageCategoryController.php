<?php

namespace App\Http\Controllers;

use App\Models\PackageCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageCategoryRequest;
use App\Http\Requests\UpdatePackageCategoryRequest;

class PackageCategoryController extends Controller
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
     * @param  \App\Http\Requests\StorePackageCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageCategory  $packageCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageCategory  $packageCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageCategoryRequest  $request
     * @param  \App\Models\PackageCategory  $packageCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageCategoryRequest $request, PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageCategory  $packageCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageCategory $packageCategory)
    {
        //
    }
}
