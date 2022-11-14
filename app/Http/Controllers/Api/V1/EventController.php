<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventDetailResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    public function index()
    {
        $eventPaginator = Event::upcoming()->with(['reviews'])->whereHas('tickets');
        $queryBuilder = QueryBuilder::for($eventPaginator)
            ->allowedFilters(['start_date'])
            ->allowedSorts('start_date')

            ->paginate()
            ->appends(request()->query());
        return new EventCollection($queryBuilder);
    }

    public function detail($id)
    {
        $event = Event::where(['id' => $id])->with('reviews')->first();
        return new EventDetailResource($event);
    }
}
