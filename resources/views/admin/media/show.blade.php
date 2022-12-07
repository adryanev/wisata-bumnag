@extends('admin.default')

@section('page-header')
Media {{ $mediaModelType }} {{ $mediaModelName }} <small><i class="c-white-500 ti-eye"></i></small>

@endsection

@section('content')
<div class="col bgc-white p-20">
    <div class="row mB-20">
        <a href="{{ $backUrl }}" class="btn btn-primary self-align-center">Back</a>

    </div>
    <div class="row">
        <img class="img-fluid" src="{{ $mediaUrl }}" alt="Media {{ $mediaModelName }}">
    </div>
</div>

@endsection
