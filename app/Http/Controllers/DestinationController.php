<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Category;
use App\Models\DestinationCategory;
use Auth;
use DB;
use Exception;
use View;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $items = Destination::createdBy(Auth::getUser()->id)->latest('created_at')->get();
        } elseif (Auth::getUser()->roles->first()->name == 'super-admin') {
              $items = Destination::latest('created_at')->get();
        }
        return view('admin.destinations.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::whereIn('parent_id', [
            Category::where('name', 'Wisata')->first()->id,
            Category::where('name', 'Kuliner')->first()->id,
            Category::where('name', 'Akomodasi')->first()->id,
            Category::where('name', 'Desa Wisata')->first()->id,
        ])->get();
        $categories = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $destinationCategory = null;
        return view('admin.destinations.create', compact('categories', 'destinationCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDestinationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestinationRequest $request)
    {
        $data = $request->except('destination_photo');
        $data['created_by'] = Auth::user()->id;

        // dd($request);

        $destination = Destination::create($data);
        $destinationCategory = $destination->categories()->attach($request['destination_category']);

        if ($request->hasFile('destination_photo')) {
            $destination->addMultipleMediaFromRequest(['destination_photo'])->each(function ($file) {
                $file->toMediaCollection('Destination');
            });
        } else {
            $destination->addMedia(storage_path('Destination/Destination'.
            fake()->numberBetween(1, 10).'.jpg'))
            ->preservingOriginal()->toMediaCollection('Destination');
        }
        return back()->withSuccess('Success Create Destination');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination = Destination::find($id);
        $media = $destination->getMedia('Destination');
        //check has media
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        //check has destiantion category or not
        if (count($destination->categories) == 0) {
            $destinationCategory = null;
        } else {
            $destinationCategory = $destination->categories->first()->name;
        }

        return view('admin.destinations.show', compact('destination', 'latestMedia', 'destinationCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::find($id);
        $category = Category::whereIn('parent_id', [
            Category::where('name', 'Wisata')->first()->id,
            Category::where('name', 'Kuliner')->first()->id,
            Category::where('name', 'Akomodasi')->first()->id,
            Category::where('name', 'Desa Wisata')->first()->id,
        ])->get();
        $categories = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $media = $destination->getMedia('Destination');
        //check has media
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        //check has destiantion category or not
        if (count($destination->categories) == 0) {
            $destinationCategory = null;
        } else {
            $destinationCategory = $destination->categories->first();
        }
        return view('admin.destinations.edit', compact(
            'destination',
            'categories',
            'destinationCategory',
            'latestMedia',
            'media'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDestinationRequest  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestinationRequest $request, $id)
    {
        $data = $request->except('destination_photo');
        $data['updated_by'] = Auth::user()->id;
        $destination = Destination::findOrFail($id);
        $destination->update($data);
        if (count($destination->categories) != 0) {
            $destination->categories()->detach();
        }
        $destinationCategory = $destination->categories()->attach($request['destination_category']);
        // dump($destination, $destinationCategory, $destination->getMedia('Destination'));

        if ($request->hasFile('destination_photo')) {
            $destination->addMultipleMediaFromRequest(['destination_photo'])->each(function ($file) {
                $file->toMediaCollection('Destination');
            });
        }

        // dd($data, $destination, $destinationCategory);
        return redirect()->route(ADMIN . '.destinations.index')->withSuccess('Success Update '.$destination->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $destination = Destination::find($id);
            $destinationName = $destination->name;
            $destination->tickets()->delete();
            $destination->souvenirs()->delete();
            $destination->reviews()->delete();
            $destination->categories()->detach();
            $destination->delete();
            DB::commit();
            return back()->withSuccess('Success Delete '.$destinationName);
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors(['message' => 'Tidak Berhasil Menghapus Destinasi']);
        }
    }
}
