@extends('admin.default')

@section('page-header')
Destination <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.destinations.store' ],
'files' => true
])
!!}

@include('admin.destinations.form')

<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

{!! Form::close() !!}

@stop
