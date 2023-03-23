<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventDetailResource;
use App\Models\Event;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    public function index()
    {
        $eventPaginator = Event::upcoming()->with(['reviews'])->wherehas('tickets', function (Builder $builder) {
            return $builder->where('quantity', '>', 5);
        })->latest('created_at');
        $queryBuilder = QueryBuilder::for($eventPaginator)
            ->allowedFilters(['start_date'])
            ->allowedSorts('start_date')

            ->paginate()
            ->appends(request()->query());
        return new EventCollection($queryBuilder);
    }

    public function detail($id)
    {
        $event = Event::where(['id' => $id])->with('reviews')->firstOrFail();
        return new EventDetailResource($event);
    }
}
