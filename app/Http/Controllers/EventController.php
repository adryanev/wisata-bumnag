<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $items = Event::createdBy(Auth::getUser()->id)->latest('created_at')->get();
        } elseif (Auth::getUser()->roles->first()->name == 'super-admin') {
             $items = Event::latest('created_at')->get();
        }
        return view('admin.events.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $latestMedia = null;
        return view('admin.events.create', compact(
            'latestMedia'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $data = $request->except('event_photo');
        $data['created_by'] = Auth::user()->id;
        $event = Event::create($data);
        if ($request->hasFile('event_photo')) {
             $event->addMultipleMediaFromRequest(['event_photo'])->each(function ($file) {
                $file->toMediaCollection('Event');
             });
        } else {
            $event->addMedia(storage_path('Event/Event'.
            fake()->numberBetween(1, 10).'.jpg'))
            ->preservingOriginal()->toMediaCollection('Event');
        }
        return back()->withSuccess('Success Create Event '.$event->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $media = $event->getMedia('Event');
        //check has media
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.events.show', compact(
            'event',
            'latestMedia',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $event['start_date'] = Carbon::parse($event['start_date'])->toDateString();
        $event['end_date'] = Carbon::parse($event['end_date'])->toDateString();
        $media = $event->getMedia('Event');
        //check has media
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }

        return view('admin.events.edit', compact(
            'event',
            'latestMedia',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $data = $request->except('event_photo');
        $data['updated_at'] = Auth::user()->id;
        $event = Event::find($id);
        $updated = $event->update($data);
        if ($request->hasFile('event_photo')) {
            $event->addMultipleMediaFromRequest(['event_photo'])->each(function ($file) {
                $file->toMediaCollection('Event');
            });
        }
        return redirect(route('admin.events.index'))->withSuccess('Success Update Event '.$event->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $eventName = $event->name;
        $event->delete();
        return back()->withSuccess('Success Delete Event '.$eventName);
    }
}
