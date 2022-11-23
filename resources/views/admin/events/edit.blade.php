@extends('admin.default')

@section('page-header')
Event {{ $event->name }}<small><i class="c-white-500 ti-brush"></i></small>
<img src="{{ $latestMedia }}" alt="User {{ $event->name }} image" height="100" width="100">
@stop

@section('content')
{!! Form::model($event, [
'route' => [ ADMIN . '.events.update', $event->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.events.form',[])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
