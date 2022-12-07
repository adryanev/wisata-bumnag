@extends('admin.default')

@section('page-header')
Destination {{ $destination->name }} <small><i class="c-white-500 ti-eye"></i></small>

<img src="{{ $latestMedia }}" alt="Destination {{ $destination->name }} image" height="100" width="100">

@endsection

@section('content')
<div class="conatainer bgc-white p-20">
    <table class="table align-item-center mb-0">
        <tr>
            <td>ID</td>
            <td>{{ $destination->id }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $destination->name}}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>{{ $destination->description}}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $destination->address}}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>{{ $destination->phone_number}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $destination->email}}</td>
        </tr>
        <tr>
            <td>Latitude</td>
            <td>{{ $destination->latitude}}</td>
        </tr>
        <tr>
            <td>Longitude</td>
            <td>{{ $destination->longitude}}</td>
        </tr>
        <tr>
            <td>Opening Hours</td>
            <td>{{ $destination->opening_hours}}</td>
        </tr>
        <tr>
            <td>Closing Hours</td>
            <td>{{ $destination->closing_hours}}</td>
        </tr>
        <tr>
            <td>Instagram</td>
            <td>{{$destination->instagram? '@'.$destination->instagram: " "}}</td>



        </tr>
        <tr>
            <td>Website</td>
            <td><a href="{{ $destination->website}}">{{ $destination->website}}</a></td>
        </tr>
        <tr>
            <td>Capacity</td>
            <td>{{$destination->capacity}}</td>
        </tr>
        <tr>
            <td>Working Day</td>
            <td>{{$destination->working_day}}</td>
        </tr>
        <tr>
            <td>Destination Category</td>
            <td>{{$destinationCategory}}</td>
        </tr>
        <tr>
            <td>Created By</td>
            <td>{{$destination->creator->name}} ({{ $destination->creator->id }})</td>
        </tr>

    </table>
</div>

@endsection
