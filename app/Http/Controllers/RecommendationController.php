<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRecommendationRequest;
use App\Models\Destination;
use Illuminate\Http\Request;
use Validator;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendations = Recommendation::all()->take(10);
        $destination = Destination::all('id', 'name');
        $destinations = $destination->mapWithKeys(function ($destination) {
            return [$destination->id => $destination->name];
        });
        $recommendationDestination = [];
        foreach ($recommendations as $recommend) {
            array_push($recommendationDestination, $recommend->destination_id);
        }
        return view('admin.recommendations.index', compact('recommendations', 'destinations', 'recommendationDestination'));
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
     * @param  \App\Http\Requests\StoreRecommendationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rank' => 'required',
            'rank.*' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors(['messages' => 'Semua inputan harus terisi']);
        }
        $data = $request->input('rank');
        // dd($data);
        if (Recommendation::count() < 10) {
            for ($i = 0; $i < 10; $i++) {
                Recommendation::create([
                    'name' => '',
                    'rank' => $i + 1,
                    'destination_id' => $data[$i],
                ]);
            }
        } else {
            for ($i = 0; $i < 10; $i++) {
                $recommendation = Recommendation::find($i + 1);
                $recommendation->destination_id = $data[$i];
                $recommendation->save();
            }
            return back()->withSuccess('Berhasil Memperbarui Rekomendasi');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function show(Recommendation $recommendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function edit(Recommendation $recommendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecommendationRequest  $request
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecommendationRequest $request, Recommendation $recommendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation)
    {
        //
    }
}
