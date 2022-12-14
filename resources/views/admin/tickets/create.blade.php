@extends('admin.default')

@section('page-header')
Ticket <small><i class="c-white-500 ti-cloud-up"></i></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.tickets.store' ],
'files' => true
])
!!}

@include('admin.tickets.form',[])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
