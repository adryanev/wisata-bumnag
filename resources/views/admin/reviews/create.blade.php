@extends('admin.default')

@section('page-header')
Review <small><i class="c-white-500 ti-cloud-up"></i></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.reviews.store' ],
'files' => true
])
!!}

@include('admin.reviews.form',[])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
