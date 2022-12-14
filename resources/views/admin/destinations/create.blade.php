@extends('admin.default')

@section('page-header')
Destination <small><i class="c-white-500 ti-cloud-up"></i></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.destinations.store' ],
'files' => true
])
!!}

@include('admin.destinations.form',['categories'=>$categories,'destinationCategory'=>$destinationCategory])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
