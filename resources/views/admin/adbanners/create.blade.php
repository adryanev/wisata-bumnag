@extends('admin.default')

@section('page-header')
Ad Banner <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.adbanners.store' ],
'files' => true
])
!!}

@include('admin.adbanners.form',[])

<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

{!! Form::close() !!}

@stop
