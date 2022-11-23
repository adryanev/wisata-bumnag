<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ReviewRequest;
use App\Http\Resources\ExploreCollection;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\ReviewCollection;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Review::whereHas('reviewable')->with('media')->orderBy('created_at', 'DESC')->paginate(10);

        return new ExploreCollection($review);
    }
    public function add(ReviewRequest $request)
    {

        $data = $request->all();
        $model = Review::create($data);

        if ($request->hasFile('media')) {
            $fileAdders = $model->addMultipleMediaFromRequest(['media'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('Review');
                });
        }

        return response()->json(
            [
                'data' => 'Berhasil menambahkan review.',
            ]
        );
    }

    public function waiting()
    {
        $user = auth()->user()->id;
        $waiting = OrderDetail::joinRelationship('order', function ($join) use ($user) {
            $join->where('orders.user_id', '=', $user)->completed();
        })->whereDoesntHave('reviews')->orderBy('created_at', 'DESC')->paginate(10);
        return OrderDetailResource::collection($waiting);
    }
    public function history()
    {
        $user = auth()->user()->id;
        $waiting = OrderDetail::joinRelationship('order', function ($join) use ($user) {
            $join->where('orders.user_id', '=', $user)->completed();
        })->whereHas('reviews')->orderBy('created_at', 'DESC')->paginate(10);
        return OrderDetailResource::collection($waiting);
    }
}
