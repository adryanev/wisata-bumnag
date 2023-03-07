@extends('admin.default')

@section('page-header')
Category <small><i class="c-white-500 ti-cloud-up"></i></small>

@stop

@section('content')
{!! Form::open([
'route' => [ ADMIN . '.categories.store' ],
'files' => true
])
!!}

@include('admin.categories.form',['categories'=>$categories,'categoryParent'=>$categoryParent])

<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
