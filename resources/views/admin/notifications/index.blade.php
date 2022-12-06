@extends('admin.default')

@section('page-header')
All Notification For User {{ $user->name }}
@endsection

@section('content')
<div class="row d-flex justify-content-end mB-15">
    <a class="btn btn-primary" href="{{ route('admin.notifications.read-all') }}">
        Read All
        <span>
            <i class="ti-check-box"></i>

        </span>

    </a>
</div>
<div class="bgc-white bd bdrs-3">
    <ul class="lis-n p-0 m-0 fsz-sm">
        @if($notifications->count() == 0)
        <li class="pX-20 pY-15 bdB">
            <p>Nothing To See Here!</p>
        </li>
        @endif
        @foreach ($notifications as $notification)
        <li @if($notification->read())
            class="pX-20 pY-15 bdB bgc-white "
            @endif
            class="pX-20 pY-15 bdB bgc-red-50">
            @if($notification->read())
            <a href="{{ route('admin.notifications.read',$notification->id) }}">
                <h3 class="text-muted">{{ $notification->data['title'] }}</h3>
                <p class="text-muted">{{ $notification->data['body'] }}</p>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </a>
            @else
            <a href="{{ route('admin.notifications.read',$notification->id) }}">
                <h3 class="text-bold text-dark">{{ $notification->data['title'] }}</h3>
                <p class="text-bold text-dark">{{ $notification->data['body'] }}</p>
                <small class="text-bold text-dark">{{ $notification->created_at->diffForHumans() }}</small>
            </a>
            @endif
        </li>
        @endforeach
    </ul>
</div>


@endsection
