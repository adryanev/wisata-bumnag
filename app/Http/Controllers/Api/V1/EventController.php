<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventDetailResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $eventPaginator = Event::with(['reviews'])->whereHas('tickets')->paginate(10);
        return new EventCollection($eventPaginator);
    }

    public function detail($id)
    {
        $event = Event::where(['id' => $id])->with('reviews')->first();
        return new EventDetailResource($event);
    }
}
