@extends('admin.default')

@section('page-header')
Souvenir <small>{{ trans('app.update_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $souvenir->name }} image" height="100" width="100">
@stop

@section('content')
{!! Form::model($souvenir, [
'route' => [ ADMIN . '.souvenirs.update', $souvenir->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.souvenirs.form',['souvenir'=>$souvenir,'categories'=>$categories,'souvenirCategory'=>$souvenirCategory,'souvenirDestination'=>$souvenirDestination])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
