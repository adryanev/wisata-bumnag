<?php

namespace App\Http\Controllers;

use App\Models\Souvenir;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSouvenirRequest;
use App\Http\Requests\UpdateSouvenirRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\SouvenirCategory;
use Auth;

class SouvenirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $items = Souvenir::createdBy(Auth::getUser()->id)->latest('created_at')->get();
        } elseif (Auth::getUser()->roles->first()->name == 'super-admin') {
              $items = Souvenir::latest('created_at')->get();
        }

        return view('admin.souvenirs.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('parent_id', Category::where('name', 'souvenir')->first()->id)->get();
        $categories = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        if (Auth::getUser()->roles->first()->name == 'super-admin') {
            $destination = Destination::all();
        } elseif (Auth::getUser()->roles->first()->name == 'admin') {
            $destination = Destination::createdBy(Auth::user()->id)->get();
        }
        $destinations = $destination->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $souvenirCategory = null;
        $souvenirDestination = null;
        $souvenir = null;

        return view('admin.souvenirs.create', compact(
            'souvenir',
            'categories',
            'destinations',
            'souvenirCategory',
            'souvenirDestination'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSouvenirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSouvenirRequest $request)
    {
        $data = $request->except('souvenir_photo', 'souvenir_category');
        $data['is_free'] = boolval($data['is_free']);
        if ($data['is_free']) {
            $data['price'] = 0;
        }
        $data['created_by'] = Auth::user()->id;
        $souvenir = Souvenir::create($data);
        $souvenir->categories()->attach($request['souvenir_category']);
        if ($request['souvenir_photo'] != null) {
            $souvenir->addMedia($request['souvenir_photo'])->toMediaCollection('Souvenir');
        }
        return back()->withSuccess('Success Create Souvenir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $souvenir = Souvenir::find($id);
        $souvenirCategory = $souvenir->categories->all();
        $souvenirDestination = $souvenir->destination->first()->name;
        $media = $souvenir->getMedia('Souvenir');

        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.souvenirs.show', compact(
            'souvenir',
            'souvenirCategory',
            'souvenirDestination',
            'latestMedia',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('parent_id', Category::where('name', 'souvenir')->first()->id)->get();
        $categories = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        if (Auth::getUser()->roles->first()->name == 'super-admin') {
            $destination = Destination::all();
        } elseif (Auth::getUser()->roles->first()->name == 'admin') {
            $destination = Destination::createdBy(Auth::user()->id)->get();
        }
        $destinations = $destination->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $souvenir = Souvenir::find($id);

        $souvenirCategory = $souvenir->categories;
        $souvenirDestination = $souvenir->destination;

        $media = $souvenir->getMedia('Souvenir');

        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }


        return view('admin.souvenirs.edit', compact(
            'souvenir',
            'categories',
            'destinations',
            'souvenirCategory',
            'souvenirDestination',
            'latestMedia',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSouvenirRequest  $request
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSouvenirRequest $request, $id)
    {
        $data = $request->except('souvenir_photo', 'souvenir_category');
        $data['is_free'] = boolval($data['is_free']);
        if ($data['is_free']) {
            $data['price'] = 0;
        }
        $data['updated_by'] = Auth::user()->id;
        $souvenir = Souvenir::find($id);
        $souvenir->update($data);
        if (count($souvenir->categories) != 0) {
            $souvenir->categories()->detach();
        }
        $souvenir->categories()->attach($request['souvenir_category']);
        if ($request['souvenir_photo'] != null) {
            $souvenir->addMedia($request['souvenir_photo'])->toMediaCollection('Souvenir');
        }
        return back()->withSuccess('Success Create Souvenir');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Souvenir  $souvenir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $souvenir = Souvenir::find($id);
        $souvenirName = $souvenir->name;
        $souvenir->delete();

        return back()->withSuccess('Success Delete '.$souvenirName);
    }
}
