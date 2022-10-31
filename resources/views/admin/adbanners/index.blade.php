@extends('admin.default')

@section('page-header')
Ad Banner <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.adbanners.create') }}" class="btn btn-info">
        {{ trans('app.add_button') }}
    </a>
</div>


<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Target</th>
                    <th>Media</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Target</th>
                    <th>Media</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><a href="{{ route(ADMIN . '.adbanners.show', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->action }}</td>
                    <td>{{ $item->target }}</td>
                    <td><img src="{{ $item->getMedia('Banner')->first()->original_url }}" alt="Ad Banner {{ $item->name }}" width="150" height="100"></td>

                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.adbanners.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                            <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.adbanners.destroy', $item->id),
                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

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
