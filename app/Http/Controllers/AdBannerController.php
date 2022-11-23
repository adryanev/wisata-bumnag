<?php

namespace App\Http\Controllers;

use App\Models\AdBanner;
use App\Http\Requests\StoreAdBannerRequest;
use App\Http\Requests\UpdateAdBannerRequest;
use Auth;
use View;

class AdBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $items = AdBanner::createdBy(Auth::getUser()->id)->get();
        } elseif (Auth::getUser()->roles->first()->name == 'super-admin') {
              $items = AdBanner::latest('updated_at')->get();
        }
        return view('admin.adbanners.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adbanners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdBannerRequest $request)
    {
        $data = $request->except('media');
        $data['created_by'] = Auth::user()->id;
        // dd($data, $request['media']);
        $adBanner = AdBanner::create($data);
        $adBanner->addMedia($request['media'])->toMediaCollection('Banner');
        return back()->withSuccess('Create Ad Banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adBanner = AdBanner::find($id);
        $media = $adBanner->getMedia('Banner');

        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.adbanners.show', compact('adBanner', 'latestMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adBanner = AdBanner::find($id);

        $media = $adBanner->getMedia('Banner');

        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.adbanners.edit', compact('adBanner', 'latestMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdBannerRequest  $request
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdBannerRequest $request, $id)
    {
        $data = $request->except('media');
        $data['updated_by'] = Auth::user()->id;
        $adBanner = AdBanner::find($id);
        $adBanner->update($data);

        if ($request['avatar'] != null) {
            $adBanner->addMedia($request['media'])->toMediaCollection('Banner');
        }
        return redirect()->route(ADMIN . '.adbanners.index')->withSuccess('Success Update '.$adBanner->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdBanner  $adBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adBanner = AdBanner::find($id);
        $adbannerName = $adBanner->name;
        $adBanner->delete();
         return back()->withSuccess('Success Delete '.$adbannerName);
    }
}
