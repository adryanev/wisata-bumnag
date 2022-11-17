@extends('admin.default')

@section('page-header')
Event {{ $event->name }} <small><i class="c-white-500 ti-eye"></i></small>

<img src="{{ $latestMedia }}" alt="User {{ $event->name }} image" height="100" width="100">

@endsection

@section('content')
<table class="table align-item-center mb-0">
    <tr>
        <td>ID</td>
        <td>{{ $event->id }}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $event->name}}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td>{{ $event->description}}</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>{{ $event->address}}</td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td>{{ $event->phone_number}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $event->email}}</td>
    </tr>
    <tr>
        <td>Latitude</td>
        <td>{{ $event->latitude}}</td>
    </tr>
    <tr>
        <td>Longitude</td>
        <td>{{ $event->longitude}}</td>
    </tr>
    <tr>
        <td>Start Date</td>
        <td>{{ $event->start_date}}</td>
    </tr>
    <tr>
        <td>End Date</td>
        <td>{{ $event->end_date}}</td>
    </tr>
    <tr>
        <td>Term and Conditions</td>
        <td>{{ $event->term_and_condition}}</td>
    </tr>
    <tr>
        <td>Instagram</td>
        <td>{{$event->instagram? '@'.$event->instagram: " "}}</td>
    </tr>
    <tr>
        <td>Website</td>
        <td><a href="{{ $event->website}}">{{ $event->website}}</a></td>
    </tr>
    <tr>
        <td>Capasity</td>
        <td>{{$event->capasity}}</td>
    </tr>



</table>

@endsection
