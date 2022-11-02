<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Category;
use App\Models\DestinationCategory;
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
        $items = Destination::latest('updated_at')->get();

        return view('admin.destinations.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $categories = $category->mapWithKeys(function ($item, $key) {
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

        // dd($request);

        $destination = Destination::create($data);
        $destinationCategory = $destination->categories()->attach($request['destination_category']);

        if ($request['destination_photo'] != null) {
            $destination->addMedia($request['destination_photo'])->toMediaCollection('Destination');
        } else {
            $destination->addMedia(storage_path('Destination/Destination'.
            fake()->numberBetween(1, 10).'.jpg'))
            ->preservingOriginal()->toMediaCollection('Destination');
        }
        return back()->withSuccess(trans('app.success_store'));
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
        $category = Category::all();
        $categories = $category->mapWithKeys(function ($item, $key) {
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
        $destination = Destination::findOrFail($id);
        $destination->update($data);
        if (count($destination->categories) != 0) {
            $destination->categories()->detach();
        }
        $destinationCategory = $destination->categories()->attach($request['destination_category']);
        // dump($destination, $destinationCategory, $destination->getMedia('Destination'));

        if ($request['destination_photo'] != null) {
            $destination->addMedia($request['destination_photo'])->toMediaCollection('Destination');
        }

        // dd($data, $destination, $destinationCategory);
        return redirect()->route(ADMIN . '.destinations.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = Destination::find($id);
        $destination->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
