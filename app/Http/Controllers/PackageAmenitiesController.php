<?php

namespace App\Http\Controllers;

use App\Models\PackageAmenities;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageAmenitiesRequest;
use App\Http\Requests\UpdatePackageAmenitiesRequest;
use App\Models\Package;

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
        $package = Package::all();
        $packages = $package->mapWithKeys(function ($package) {
            return [$package->id => $package->name];
        });
        $amenityPackage = null;
        return view('admin.amenities.create', compact('packages', 'amenityPackage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageAmenitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageAmenitiesRequest $request)
    {
        $data = $request->all();
        $data['package_id'] = $data['amenity_package'];
        $amenityPackage = PackageAmenities::create($data);
        return back()->withSuccess(
            'Success Create Package Amenitiy '.$amenityPackage->name.
            ' in Package '.$amenityPackage->package->name
        );
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
    public function edit($id)
    {
        $amenity = PackageAmenities::find($id);
        $amenityPackage = $amenity->package;
        $package = Package::all();
        $packages = $package->mapWithKeys(function ($package) {
            return [$package->id => $package->name];
        });
        return view('admin.amenities.edit', compact('amenity', 'amenityPackage', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageAmenitiesRequest  $request
     * @param  \App\Models\PackageAmenities  $packageAmenities
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageAmenitiesRequest $request, $id)
    {
        $packageAmenities = PackageAmenities::find($id);
        $data = $request->all();
        $data['package_id'] = $data['amenity_package'];

        $packageAmenities->update($data);
        return back()->withSuccess('Success Edit Amenity '.$packageAmenities->name);
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
