@extends('admin.default')

@section('page-header')
Recommendations
<i class="ti-star"></i>
@endsection

@section('content')

{!! Form::open([
'route' => [ ADMIN . '.recommendations.store' ],
'files' => true
])
!!}
<div class="col">@include('admin.recommendations.form',[$recommendationDestination])</div>
<div class="col"><button type="submit" class="btn btn-primary " onclick=""><i class="c-white-500 ti-save"></i>&nbsp;Submit</button></div>
{!! Form::close() !!}






@endsection
