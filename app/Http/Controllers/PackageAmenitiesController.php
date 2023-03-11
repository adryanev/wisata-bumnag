<?php

namespace App\Http\Controllers;

use App\Models\PackageAmenities;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageAmenitiesRequest;
use App\Http\Requests\UpdatePackageAmenitiesRequest;

class PackageAmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PackageAmenities::latest('created_at')->get();
        return view('admin.amenities.index', compact('items'));
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
     * @param  \App\Http\Requests\StorePackageAmenitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageAmenitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageAmenities  $packageAmenities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $amenity = PackageAmenities::find($id);
        $amenityPackage = $amenity->package;
        return view('admin.amenities.show', compact('amenity', 'amenityPackage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageAmenities  $packageAmenities
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageAmenities $packageAmenities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageAmenitiesRequest  $request
     * @param  \App\Models\PackageAmenities  $packageAmenities
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageAmenitiesRequest $request, PackageAmenities $packageAmenities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageAmenities  $packageAmenities
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageAmenities $packageAmenities)
    {
        //
    }
}
