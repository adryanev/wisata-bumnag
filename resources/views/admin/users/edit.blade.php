@extends('admin.default')

@section('page-header')
User <small>{{ trans('app.update_item') }}</small>
<img src="{{ $latestMedia }}" alt="User {{ $user->name }} image" height="100" width="100">



@stop

@section('content')
{!! Form::model($user, [
'route' => [ ADMIN . '.users.update', $user->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.users.form',['roles'=> $roles,'userRole'=>$userRole])


<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

{!! Form::close() !!}

@stop
