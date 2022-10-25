@extends('admin.default')

@section('page-header')
User {{ $user->name }} <small>{{ trans('app.show_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $user->name }} image" height="100" width="100">




@endsection

@section('content')
<table class="table align-item-center mb-0">
    <tr>
        <td>ID</td>
        <td>{{ $user->id }}</td>
    </tr>
    <tr>
        <td>Nomor Induk Keluarga</td>
        <td>{{ $user->nik }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td>{{ $user->phone_number }}</td>
    </tr>
    <tr>
        <td>Role</td>
        <td>{{ $user->roles()->first()? $user->roles()->first()->name : 'Has No Roles' }}</td>

    </tr>

</table>

@endsection
