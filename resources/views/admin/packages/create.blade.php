@extends('admin.default')

@section('page-header')
Souvenirs <small><i class="c-white-500 ti-cloud-up"></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.souvenirs.store' ],
'files' => true
])
!!}

@include('admin.souvenirs.form',['categories'=>$categories,'destinations'=>$destinations,'souvenirCategory'=>$souvenirCategory,'souvenirDestination'=>$souvenirDestination,'souvenir'=>$souvenir])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
