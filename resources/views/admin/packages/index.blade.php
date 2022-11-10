@extends('admin.default')

@section('page-header')
Packages <small><i class="c-white-500 ti-harddrive"></i></small>

@endsection

@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.packages.create') }}" class="btn btn-info">
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
                    <th>Price Include</th>
                    <th>Price Exclude</th>
                    <th>Activities</th>
                    <th>Destinations</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Price Include</th>
                    <th>Price Exclude</th>
                    <th>Activities</th>
                    <th>Destinations</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><a href="{{ route(ADMIN . '.packages.show', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->price_include }}</td>
                    <td>
                        {{ $item->price_exclude }}
                    </td>
                    <td>{{ $item->activities }}</td>
                    <td>{{ $item->destination}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.packages.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                            <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.packages.destroy', $item->id),
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
