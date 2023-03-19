@extends('admin.default')

@section('page-header')
Category {{ $category->name }}<small><i class="c-white-500 ti-brush"></i></small>
@stop

@section('content')
{!! Form::model($category, [
'route' => [ ADMIN . '.categories.update', $category->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.categories.form',['category'=>$category,'categories'=>$categories,'categoryParent'=>$categoryParent])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@stop
