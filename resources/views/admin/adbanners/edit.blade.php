@extends('admin.default')

@section('page-header')
Ad Banner <small>{{ trans('app.update_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $adBanner->name }} image" height="100" width="100">



@stop

@section('content')
{!! Form::model($adBanner, [
'route' => [ ADMIN . '.adbanners.update', $adBanner->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.adbanners.form',[])


<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

{!! Form::close() !!}

@stop
