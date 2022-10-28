@extends('admin.default')

@section('page-header')
AdBanner {{ $adBanner->name }} <small>{{ trans('app.show_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $adBanner->name }} image" height="100" width="100">




@endsection

@section('content')
<table class="table align-item-center mb-0">
    <tr>
        <td>ID</td>
        <td>{{ $adBanner->id }}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $adBanner->name }}</td>
    </tr>
    <tr>
        <td>Action</td>
        <td>{{ $adBanner->Action }}</td>
    </tr>
    <tr>
        <td>Target</td>
        <td>{{ $adBanner->target }}</td>
    </tr>

</table>

@endsection