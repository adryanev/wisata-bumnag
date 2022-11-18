@extends('admin.default')

@section('page-header')
Review {{ $review->title }} <small><i class="c-white-500 ti-eye"></i></small>

<img src="{{ $latestMedia }}" alt="Review {{ $review->title }} image" height="100" width="100">

@endsection

@section('content')
<div class="conatainer bgc-white p-20">
    <table class="table align-item-center mb-0">
        <tr>
            <td>ID</td>
            <td>{{ $review->id }}</td>
        </tr>
        <tr>
            <td>Title</td>
            <td>{{ $review->title}}</td>
        </tr>
        <tr>
            <td>Reviewable Type</td>
            <td>@switch($review->reviewable_type)
                @case('App\\Models\\Destination')
                Destination
                @break
                @case('App\\Models\\Souvenir')
                Souvenir
                @break
                @case('App\\Models\\Package')
                Package
                @break
                @case('App\\Models\\Ticket')
                Ticket
                @break

                @default
                {{ $review->reviewable_type }}
                @endswitch
            </td>
        </tr>
        <tr>
            <td>Reviewable ID</td>
            <td>{{ $review->reviewable_id }}</td>
        </tr>
        <tr>
            <td>Rating</td>
            <td>{{ $review->rating }}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>{{ $review->description }}</td>
        </tr>
        <tr>
            <td>User</td>
            <td>
                {{ $review->user->id }}
                <br>
                {{ $review->user->name }}
            </td>
        </tr>

    </table>
</div>


@endsection
