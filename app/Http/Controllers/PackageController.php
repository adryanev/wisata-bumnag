<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Category;
use Auth;
use DB;
use Exception;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $items = Package::createdBy(Auth::getUser()->id)->latest('created_at')->get();
        } elseif (Auth::getUser()->roles->first()->name == 'super-admin') {
            $items = Package::latest('created_at')->get();
        }
        return view('admin.packages.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('parent_id', Category::where('name', 'Package')->get()->first()->id)->get();
        $categories = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $packageCategory = null;
        return view('admin.packages.create', compact(
            'categories',
            'packageCategory',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        $data = $request->except('package_photo');
        $data['created_by'] = Auth::user()->id;
        // dd($request);
        $package = Package::create($data);
        $packageCategory = $package->categories()->attach($data['package_category']);
        if ($request->hasFile('package_photo')) {
            $package->addMultipleMediaFromRequest(['package_photo'])->each(function ($file) {
                $file->toMediaCollection('Package');
            });
        } else {
            $package->addMedia(storage_path('Package/Package'.
            fake()->numberBetween(1, 10).'.jpg'))
            ->preservingOriginal()->toMediaCollection('Package');
        }
        return back()->withSuccess('Success add Package '.$package->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);
        $packageCategory = $package->categories;
        $media = $package->getMedia('Package');
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.packages.show', compact(
            'package',
            'packageCategory',
            'latestMedia',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        $category = Category::where('parent_id', Category::where('name', 'Package')->get()->first()->id)->get();
        $categories = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $packageCategory = $package->categories;

        $media = $package->getMedia('Package');
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.packages.edit', compact(
            'package',
            'categories',
            'packageCategory',
            'latestMedia',
            'media',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, $id)
    {
        $data = $request->except('package_photo');
        $data['updated_by'] = Auth::user()->id;
         // dd($request);
        $package = Package::find($id);
        $packageUpdated = $package->update($data);
        if (count($package->categories) != 0) {
            $package->categories()->detach();
        }
        $packageCategory = $package->categories()->attach($request['package_category']);
        if ($request->hasFile('package_photo')) {
            $package->addMultipleMediaFromRequest(['package_photo'])->each(function ($file) {
                $file->toMediaCollection('Package');
            });
        }
        return back()->withSuccess('Success add Package '.$package->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $package = Package::find($id);
            $packageName = $package->name;
            $package->tickets()->delete();
            $package->reviews()->delete();
            $package->categories()->detach();
            $package->delete();
            DB::commit();
            return back()->withSuccess('Success Delete '.$packageName);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => 'Tidak Berhasil Menghapus Paket']);
        }
    }
}
