@extends('admin.default')

@section('page-header')
Package {{ $package->name }} <small><i class="c-white-500 ti-eye"></i></small>

<img src="{{ $latestMedia }}" alt="Package {{ $package->name }} image" height="100" width="100">

@endsection

@section('content')
<table class="table align-item-center mb-0">
    <tr>
        <td>ID</td>
        <td>{{ $package->id }}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $package->name}}</td>
    </tr>
    <tr>
        <td>Activities</td>
        <td>{{ $package->activities}}</td>
    </tr>
    <tr>
        <td>Price Include</td>
        <td>{{ $package->price_include}}</td>
    </tr>
    <tr>
        <td>Price Exclude</td>
        <td>{{ $package->price_exclude}}</td>
    </tr>
    <tr>
        <td>Destination</td>
        <td>{{ $package->destination}}</td>
    </tr>
    <tr>
        <td>Package Category</td>
        <td>
            @foreach ($packageCategory as $category)
            {{ $category->name }}
            <br>
            @endforeach
        </td>

    </tr>

</table>

@endsection
