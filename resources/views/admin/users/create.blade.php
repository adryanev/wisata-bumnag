@extends('admin.default')

@section('page-header')
User <small><i class="c-white-500 ti-cloud-up"></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.users.store' ],
'files' => true
])
!!}

@include('admin.users.form',['roles'=>$roles,'userRole'=>$userRole])

<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

{!! Form::close() !!}

@stop
