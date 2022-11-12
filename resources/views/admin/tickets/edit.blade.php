@extends('admin.default')

@section('page-header')
Ticket <small>{{ trans('app.update_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $ticket->name }} image" height="100" width="100">
@stop

@section('content')
{!! Form::model($ticket, [
'route' => [ ADMIN . '.tickets.update', $ticket->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.tickets.form',['ticket'=>$ticket,'categories'=>$categories,'ticketCategory'=>$ticketCategory,'ticketDestination'=>$ticketDestination])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
