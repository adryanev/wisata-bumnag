@extends('admin.default')

@section('page-header')
Packages <small>{{ trans('app.update_item') }}</small>
<img src="{{ $latestMedia }}" alt="Package {{ $package->name }} image" height="100" width="100">
@stop

@section('content')
{!! Form::model($package, [
'route' => [ ADMIN . '.packages.update', $package->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.packages.form',[])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
