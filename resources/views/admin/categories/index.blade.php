@extends('admin.default')

@section('page-header')
Categories <small><i class="c-white-500 ti-harddrive"></i></small>

@endsection

@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.categories.create') }}" class="btn btn-info">
        Create&nbsp;
        <i class="c-white-500 ti-plus"></i>
    </a>
</div>


<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td><a href="{{ route(ADMIN . '.categories.show', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->parent ? $item->parent->name : "null" }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.categories.edit', $item->id) }}" title="Edit" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                            <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.categories.destroy', $item->id),
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
