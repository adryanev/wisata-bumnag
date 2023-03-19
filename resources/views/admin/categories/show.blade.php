@extends('admin.default')

@section('page-header')
Category {{ $category->name }} <small><i class="c-white-500 ti-eye"></i></small>


@endsection

@section('content')
<div class="container bgc-white p-20">
    <table class="table align-item-center mb-0">
        <tr>
            <td>ID</td>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $category->name}}</td>
        </tr>
        <tr>
            <td>Position</td>
            <td>{{ $category->position}}</td>
        </tr>
    </table>
</div>

@if($categoryParent != null)
<hr>
<h4 class="c-grey-900">Category Parent Info</h4>
<div class="container bgc-white p-20">
    <table class="table align-item-center mb-0">
        <tr>
            <td>Parent ID</td>
            <td>{{ $categoryParent->id }}</td>
        </tr>
        <tr>
            <td>Parent Name</td>
            <td>{{ $categoryParent->name}}</td>
        </tr>
        <tr>
            <td>Parent Position</td>
            <td>{{ $categoryParent->position}}</td>
        </tr>
    </table>
</div>
@endif


@endsection
