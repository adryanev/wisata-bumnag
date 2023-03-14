@extends('admin.default')

@section('page-header')
Amenity <small><i class="c-white-500 ti-cloud-up"></i></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.amenities.store' ],
'files' => true
])
!!}

@include('admin.amenities.form',[])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
