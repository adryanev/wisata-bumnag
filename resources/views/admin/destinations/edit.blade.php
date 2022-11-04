@extends('admin.default')

@section('page-header')
Destination <small>{{ trans('app.update_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $destination->name }} image" height="100" width="100">
@stop

@section('content')
{!! Form::model($destination, [
'route' => [ ADMIN . '.destinations.update', $destination->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.destinations.form',['destination'=>$destination,'categories'=>$categories,'destinationCategory'=>$destinationCategory])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
