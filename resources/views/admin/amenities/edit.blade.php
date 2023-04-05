@extends('admin.default')

@section('page-header')
Amenity <small><i class="c-white-500 ti-brush"></i></small>

@stop

@section('content')
{!! Form::model($amenity, [
'route' => [ ADMIN . '.amenities.update', $amenity->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.amenities.form',[])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}


@stop
