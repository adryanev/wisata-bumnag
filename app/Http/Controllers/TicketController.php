<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Package;
use App\Models\TicketSetting;
use Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $items = Ticket::createdBy(Auth::getUser()->id)->get();
        } elseif (Auth::getUser()->roles->first()->name == 'superadmin') {
              $items = Ticket::latest('updated_at')->get();
        }
        return view('admin.tickets.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = null;
        $ticketable_type = [Event::class => 'Event',Package::class => 'Package',Destination::class => 'Destination'];
        $destination  = DB::table('destinations')->where('created_by', Auth::user()->id)->select('id', 'name')->get();
        $destinations = $destination->mapWithKeys(function ($destination) {
            return [$destination->id => $destination->name];
        });
        $event = Event::createdBy(Auth::user()->id)->get();
        $events = $event->mapWithKeys(function ($event) {
            return [$event->id => $event->name];
        });
        $package = Package::createdBy(Auth::user()->id)->get();
        $packages = $package->mapWithKeys(function ($package) {
            return [$package->id => $package->name];
        });
        $ticket_setting = null;

        return view('admin.tickets.create', compact(
            'ticket',
            'ticketable_type',
            'destinations',
            'events',
            'packages',
            'ticket_setting',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $data = $request;
        $data['is_free'] = boolval($data['is_free']);
        if ($data['is_free']) {
            $data['price'] = 0;
        }
        $data['is_quantity_limited'] = boolval($data['is_quantity_limited']);
        if (!$data['is_quantity_limited']) {
            $data['quantity'] = 0;
        }
        $data['is_per_pax'] = boolval($data['is_per_pax']);
        if (!$data['is_per_pax']) {
            $data['pax_constraint'] = 0;
        }
        $data['is_per_day'] = boolval($data['is_per_day']);
        if (!$data['is_per_day']) {
            $data['day_constraint'] = '';
        }
        $data['is_per_age'] = boolval($data['is_per_age']);
        if (!$data['is_per_age']) {
            $data['age_constraint'] = 0;
        }
        $data['updated_by'] = Auth::user()->id;
        $ticket = Ticket::create($data->except([
            'is_per_pax','pax_constraint','is_per_day','day_constraint','is_per_age','age_constraint',
        ]));
        $ticket_setting_data = $data->only([
            'is_per_pax', 'pax_constraint', 'is_per_day', 'day_constraint', 'is_per_age', 'age_constraint',
        ]);
        $ticket_setting_data['ticket_id'] = $ticket->id;
        $ticket_settings = new TicketSetting($ticket_setting_data);
        $ticket_setting = $ticket->ticketSetting()->save($ticket_settings);
        return back()->withSuccess('Create Ticket Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $ticketable_type = explode('\\', $ticket->ticketable_type);
        $ticketable_type = end($ticketable_type);
        return view('admin.tickets.show', compact('ticket', 'ticketable_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $ticketable_type = [Event::class => 'Event',Package::class => 'Package',Destination::class => 'Destination'];
        $destination  = DB::table('destinations')->where('created_by', Auth::user()->id)->select('id', 'name')->get();
        $destinations = $destination->mapWithKeys(function ($destination) {
            return [$destination->id => $destination->name];
        });
        $event = Event::createdBy(Auth::user()->id)->get();

        $events = $event->mapWithKeys(function ($event) {
            return [$event->id => $event->name];
        });
        $package = Package::createdBy(Auth::user()->id)->get();
        $packages = $package->mapWithKeys(function ($package) {
            return [$package->id => $package->name];
        });
        $ticket_setting = $ticket->ticketSetting;
         return view('admin.tickets.edit', compact(
             'ticket',
             'ticketable_type',
             'destinations',
             'events',
             'packages',
             'ticket_setting',
         ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $data = $request;
        $ticket = Ticket::find($id);
        $data['is_free'] = boolval($data['is_free']);
        if ($data['is_free']) {
            $data['price'] = 0;
        }
        $data['is_quantity_limited'] = boolval($data['is_quantity_limited']);
        if (!$data['is_quantity_limited']) {
            $data['quantity'] = 0;
        }
        $data['is_per_pax'] = boolval($data['is_per_pax']);
        if (!$data['is_per_pax']) {
            $data['pax_constraint'] = 0;
        }
        $data['is_per_day'] = boolval($data['is_per_day']);
        if (!$data['is_per_day']) {
            $data['day_constraint'] = '';
        }
        $data['is_per_age'] = boolval($data['is_per_age']);
        if (!$data['is_per_age']) {
            $data['age_constraint'] = 0;
        }
        $data['updated_by'] = Auth::user()->id;
        $ticket->update($data->except([
            'is_per_pax','pax_constraint','is_per_day','day_constraint','is_per_age','age_constraint',
        ]));
        $ticket_setting_data = $data->only([
            'is_per_pax', 'pax_constraint', 'is_per_day', 'day_constraint', 'is_per_age', 'age_constraint',
        ]);
        $ticket_setting_data['ticket_id'] = $ticket->id;
        if (count($ticket->ticketSetting->get()) != 0) {
            $ticket->ticketSetting()->delete();
        }
        $ticket_settings = new TicketSetting($ticket_setting_data);
        $ticket_setting = $ticket->ticketSetting()->save($ticket_settings);
        // dd($ticket, $ticket_settings, $ticket->ticketSetting);
        return redirect(route('admin.tickets.index'))->withSuccess('Success Edit '.$ticket->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticketName = $ticket->name;
        $ticket->delete();
        return back()->withSuccess('Success Delete '.$ticketName);
    }
}
