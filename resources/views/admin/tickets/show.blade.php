@extends('admin.default')

@section('page-header')
Ticket {{ $ticket->name }} <small><i class="c-white-500 ti-eye"></small>

{{-- <img src="{{ $latestMedia }}" alt="User {{ $ticket->name }} image" height="100" width="100"> --}}

@endsection

@section('content')
<table class="table align-item-center mb-0">
    <tr>
        <td>ID</td>
        <td>{{ $ticket->id }}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $ticket->name}}</td>
    </tr>
    <tr>
        <td>Price</td>
        <td>{{ $ticket->price}}</td>
    </tr>
    <tr>
        <td>Is Free</td>
        <td>@switch($ticket->is_free)
            @case(0)
            False
            @break
            @case(1)
            True
            @break

            @default
            {{ $ticket->is_free }}
            @endswitch
        </td>
    </tr>
    <tr>
        <td>Term and Conditions</td>
        <td>{{ $ticket->term_and_conditions}}</td>
    </tr>
    <tr>
        <td>Quantity</td>
        <td>{{ $ticket->quantity}}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td>{{ $ticket->description}}</td>
    </tr>
    <tr>
        <td>Ticketable Type</td>
        <td>{{ $ticketable_type }}</td>
    </tr>
    <tr>
        <td>Ticketable id</td>
        <td>{{ $ticket->ticketable_id }}</td>
    </tr>

</table>

@endsection
