@extends('admin.default')

@section('page-header')
Package Amenity {{ $amenity->name }} <small><i class="c-white-500 ti-eye"></i></small>


@endsection

@section('content')
<div class="conatainer bgc-white p-20">
    <table class="table align-item-center mb-0">
        <tr>
            <td>ID</td>
            <td>{{ $amenity->id }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $amenity->name}}</td>
        </tr>
        <tr>
            <td>Price </td>
            <td>{{ $amenity->price}}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>{{ $amenity->description}}</td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>{{ $amenity->quantity}}</td>
        </tr>
        <tr>
            <td>Package ID</td>
            <td>{{ $amenity->package_id}}</td>
        </tr>
    </table>
</div>

<hr>
<h4 class="c-grey-900">Package from Amenity Info</h4>
<div class="container bgc-white p-20">
    <table class="table align-item-center mb-0">
        <tr>
            <td>Package ID</td>
            <td>{{ $amenityPackage->id }}</td>
        </tr>
        <tr>
            <td>Package Name</td>
            <td>{{ $amenityPackage->name}}</td>
        </tr>
        <tr>
            <td>Package Activities</td>
            <td>{{ $amenityPackage->activities}}</td>
        </tr>
        <tr>
            <td>Package Price Include</td>
            <td>{{ $amenityPackage->price_include}}</td>
        </tr>
        <tr>
            <td>Package Price Exclude</td>
            <td>{{ $amenityPackage->price_exclude}}</td>
        </tr>
        <tr>
            <td>Package Destination</td>
            <td>{{ $amenityPackage->destination}}</td>
        </tr>

    </table>
</div>



@endsection
