<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Souvenir;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Review::latest('updated_at')->get();
        return view('admin.reviews.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reviewable_type = [
            Souvenir::class => 'Souvenir',
            Ticket::class => 'Ticket',
            Package::class => 'Package',
            Destination::class => 'Destination',
        ];
        $destination = Destination::all('id', 'name');
        $destinations = $destination->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $souvenir = Souvenir::all('id', 'name');
        $souvenirs = $souvenir->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $package = Package::all('id', 'name');
        $packages = $package->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $ticket = Ticket::all('id', 'name');
        $tickets = $ticket->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $user = User::all('id', 'name');
        $users = $user->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $latestMedia = null;
        $review = null;
        $reviewUser = null;
        return view('admin.reviews.create', compact(
            'review',
            'reviewable_type',
            'destinations',
            'souvenirs',
            'packages',
            'tickets',
            'users',
            'reviewUser',
            'latestMedia'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $data = $request->except('review_photo');
        $review = Review::create($data);
        if ($request['review_photo'] != null) {
            $review->addMedia($request['review_photo'])->toMediaCollection('Review');
        }
        return back()->withSuccess('Success Create Review');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        $media = $review->getMedia('Review');
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.reviews.show', compact('review', 'latestMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reviewable_type = [
            Souvenir::class => 'Souvenir',
            Ticket::class => 'Ticket',
            Package::class => 'Package',
            Destination::class => 'Destination',
        ];
        $destination = Destination::all('id', 'name');
        $destinations = $destination->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $souvenir = Souvenir::all('id', 'name');
        $souvenirs = $souvenir->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $package = Package::all('id', 'name');
        $packages = $package->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $ticket = Ticket::all('id', 'name');
        $tickets = $ticket->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $user = User::all('id', 'name');
        $users = $user->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $review = DB::table('reviews')->where('id', $id)->first();
        $reviewUser = User::find($review->user_id);
        // dd($review,$reviewUser);
        return view('admin.reviews.edit', compact(
            'review',
            'reviewable_type',
            'destinations',
            'souvenirs',
            'packages',
            'tickets',
            'users',
            'reviewUser',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        $data = $request->except('review_photo');
        $review = Review::find($id);
        $review->update($data);
        if ($request['review_photo'] != null) {
            $review->addMedia($request['review_photo'])->toMediaCollection('Review');
        }
        return redirect(route('admin.reviews.index'))->withSuccess('Success Update Review');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        $reviewName = $review->title;
        $review->delete();
        return back()->withSuccess('Success Delete Review '.$reviewName);
    }
}
