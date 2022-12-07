@extends('admin.default')

@section('page-header')
Profile {{ $user->name }}
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-end mB-15">
        <a class="btn btn-primary" href="{{ route('admin.profiles.edit') }}">
            Edit
            <span>
                <i class="ti-pencil"></i>
            </span>

        </a>
    </div>
    <div class="row">
        <div class="container bgc-white p-20">
            <div class="row">
                <div class="col-4">
                    <img src="{{ $user->avatar }}" alt="User {{ $user->name }} Avatar" width="300px" height="auto">
                </div>
                <div class="col-8">
                    <table class="table align-item-center mb-0">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Induk Keluarga (NIK)</td>
                            <td>{{ $user->nik }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>{{ $user->roles->first()->name }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
