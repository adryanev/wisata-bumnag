@extends('admin.default')

@section('page-header')
Edit Profile {{ $user->name }}
@endsection

@section('content')
{!! Form::model($user,[
'route'=>[ADMIN.'.profiles.update-profile',$user],
'method'=>'put',
'files'=>true,
'id'=>'profile'
])
!!}
@include('admin.profile.form-profile')
<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}
{!! Form::open([
'route'=>[ADMIN.'.profiles.update-password',$user],
'method'=>'put',
'id'=>'password'
])
!!}
@include('admin.profile.form-password')
<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}


@endsection
