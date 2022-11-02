@extends('admin.default')

@section('page-header')
Souvenir {{ $souvenir->name }} <small>{{ trans('app.show_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $souvenir->name }} image" height="100" width="100">

@endsection

@section('content')
<table class="table align-item-center mb-0">
    <tr>
        <td>ID</td>
        <td>{{ $souvenir->id }}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $souvenir->name}}</td>
    </tr>
    <tr>
        <td>Price</td>
        <td>{{ $souvenir->price}}</td>
    </tr>
    <tr>
        <td>Is Free</td>
        <td>@switch($souvenir->is_free)
            @case(0)
            False
            @break
            @case(1)
            True
            @break

            @default
            {{ $souvenir->is_free }}
            @endswitch
        </td>
    </tr>
    <tr>
        <td>Term and Conditions</td>
        <td>{{ $souvenir->term_and_conditions}}</td>
    </tr>
    <tr>
        <td>Quantity</td>
        <td>{{ $souvenir->quantity}}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td>{{ $souvenir->description}}</td>
    </tr>
    <tr>
        <td>Souvenir Destination</td>
        <td>{{ $souvenirDestination}}</td>
    </tr>
    <tr>
        <td>Souvenir Category</td>
        <td>{{ $souvenirCategory}}</td>
    </tr>

</table>

@endsection
