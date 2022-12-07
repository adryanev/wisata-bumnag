@extends('admin.default')

@section('page-header')
Reviews <small><i class="c-white-500 ti-harddrive"></i></small>

@endsection

@section('content')

{{-- <div class="mB-20">
    <a href="{{ route(ADMIN . '.reviews.create') }}" class="btn btn-info">
Create&nbsp;
<i class="c-white-500 ti-plus"></i>
</a>
</div> --}}


<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Reviewable Type</th>
                    <th>Rating</th>
                    <th>User</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Reviewable Type</th>
                    <th>Rating</th>
                    <th>User</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><a href="{{ route(ADMIN . '.reviews.show', $item->id) }}">{{ $item->title }}</a></td>
                    <td>@switch($item->reviewable_type)
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
                        {{ $item->reviewable_type }}
                        @endswitch
                    </td>
                    <td>{{ $item->rating }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->description}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.reviews.edit', $item->id) }}" title="Edit" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                            <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.reviews.destroy', $item->id),
                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
