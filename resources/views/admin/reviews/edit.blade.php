@extends('admin.default')

@section('page-header')
Review <small><i class="c-white-500 ti-brush"></i></small>
{{-- <img src="{{ $latestMedia }}" alt="Review {{ $review->name }} image" height="100" width="100"> --}}
@stop

@section('content')
{!! Form::model($review, [
'route' => [ ADMIN . '.reviews.update', $review->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.reviews.form',[])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
