@extends('admin.default')

@section('page-header')
Ad Banner <small><i class="c-white-500 ti-cloud-up"></i></small>


@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.adbanners.store' ],
'files' => true
])
!!}

@include('admin.adbanners.form',[])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>




{!! Form::close() !!}

@stop
