@extends('admin.default')

@section('page-header')
Orders <small><i class="c-white-500 ti-harddrive"></i></small>

@endsection
@section('content')
<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <h3>Order Created</h3>
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($orders as $order)
                @if($order->status !=0)
                @continue
                @endif
                <tr>
                    <td><a href="{{ route(ADMIN . '.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                    <td>{{ $order->note }}</td>
                    <td>
                        @switch($order->status)
                        @case(0)
                        Created
                        @break
                        @case(1)
                        Paid
                        @break
                        @case(2)
                        Cancelled
                        @break
                        @case(3)
                        Completed
                        @break
                        @case(4)
                        Refunded
                        @break
                        @default
                        {{ $order->status }}
                        @endswitch
                    </td>
                    <td>{{ ($order->user != null)? $order->user->name : User Deleted }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.show', $order->id) }}" title="Show" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.paid', $order->id) }}" title="Paid" class="btn btn-primary btn-sm"><span class="ti-money"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.cancel', $order->id) }}" title="Cancel" class="btn btn-warning btn-sm"><span class="ti-control-stop"></span></a>
                            </li>

                            {{-- <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.orders.destroy', $order->id),

                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li> --}}


                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <h3>Order Paid</h3>
    <div class="table-responsive">
        <table id="dataTable1" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($orders as $order)
                @if($order->status !=1)
                @continue
                @endif
                <tr>
                    <td><a href="{{ route(ADMIN . '.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                    <td>{{ $order->note }}</td>
                    <td>
                        @switch($order->status)
                        @case(0)
                        Created
                        @break
                        @case(1)
                        Paid
                        @break
                        @case(2)
                        Cancelled
                        @break
                        @case(3)
                        Completed
                        @break
                        @case(4)
                        Refunded
                        @break
                        @default
                        {{ $order->status }}
                        @endswitch
                    </td>
                    <td>{{ ($order->user != null)? $order->user->name : User Deleted }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.show', $order->id) }}" title="Show" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.refund', $order->id) }}" title="Refund" class="btn btn-primary btn-sm"><span class="ti-archive"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.complete', $order->id) }}" title="Compelete" class="btn btn-primary btn-sm"><span class="ti-check"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.cancel', $order->id) }}" title="Cancel" class="btn btn-warning btn-sm"><span class="ti-control-stop"></span></a>
                            </li>
                            {{-- <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.orders.destroy', $order->id),

                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li> --}}


                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <h3>Order Cancelled</h3>
    <div class="table-responsive">
        <table id="dataTable2" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($orders as $order)
                @if($order->status !=2)
                @continue
                @endif
                <tr>
                    <td><a href="{{ route(ADMIN . '.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                    <td>{{ $order->note }}</td>
                    <td>
                        @switch($order->status)
                        @case(0)
                        Created
                        @break
                        @case(1)
                        Paid
                        @break
                        @case(2)
                        Cancelled
                        @break
                        @case(3)
                        Completed
                        @break
                        @case(4)
                        Refunded
                        @break
                        @default
                        {{ $order->status }}
                        @endswitch
                    </td>
                    <td>{{ ($order->user != null)? $order->user->name : User Deleted }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.show', $order->id) }}" title="Show" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                            </li>
                            {{-- <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.orders.destroy', $order->id),

                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li> --}}


                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <h3>Order Completed</h3>
    <div class="table-responsive">
        <table id="dataTable3" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($orders as $order)
                @if($order->status !=3)
                @continue
                @endif
                <tr>
                    <td><a href="{{ route(ADMIN . '.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                    <td>{{ $order->note }}</td>
                    <td>
                        @switch($order->status)
                        @case(0)
                        Created
                        @break
                        @case(1)
                        Paid
                        @break
                        @case(2)
                        Cancelled
                        @break
                        @case(3)
                        Completed
                        @break
                        @case(4)
                        Refunded
                        @break
                        @default
                        {{ $order->status }}
                        @endswitch
                    </td>
                    <td>{{ ($order->user != null)? $order->user->name : User Deleted }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.show', $order->id) }}" title="Show" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                            </li>
                            {{-- <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.orders.destroy', $order->id),
                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li> --}}


                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <h3>Order Refunded</h3>
    <div class="table-responsive">
        <table id="dataTable4" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Number</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($orders as $order)
                @if($order->status !=4)
                @continue
                @endif
                <tr>
                    <td><a href="{{ route(ADMIN . '.orders.show', $order->id) }}">{{ $order->number }}</a></td>
                    <td>{{ $order->note }}</td>
                    <td>
                        @switch($order->status)
                        @case(0)
                        Created
                        @break
                        @case(1)
                        Paid
                        @break
                        @case(2)
                        Cancelled
                        @break
                        @case(3)
                        Completed
                        @break
                        @case(4)
                        Refunded
                        @break
                        @default
                        {{ $order->status }}
                        @endswitch
                    </td>
                    <td>{{ ($order->user != null)? $order->user->name : User Deleted }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route(ADMIN . '.orders.show', $order->id) }}" title="Show" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                            </li>
                            {{-- <li class="list-inline-item">
                                {!! Form::open([
                                'class'=>'delete',
                                'url' => route(ADMIN . '.orders.destroy', $order->id),

                                'method' => 'DELETE',
                                ])
                                !!}

                                <button class="btn btn-danger btn-sm" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li> --}}


                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection

@push('css')
<style>
    .dataTable tr th:last-of-type {
        min-width: 95px;
    }

</style>

@endpush
@push('js')
<script>
    $('#dataTable1').DataTable({
        language: {
            // 'url' : 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json'
            // More languages : http://www.datatables.net/plug-ins/i18n/
        }
        , aaSorting: []
    });
    $('#dataTable2').DataTable({
        language: {
            // 'url' : 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json'
            // More languages : http://www.datatables.net/plug-ins/i18n/
        }
        , aaSorting: []
    });
    $('#dataTable3').DataTable({
        language: {
            // 'url' : 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json'
            // More languages : http://www.datatables.net/plug-ins/i18n/
        }
        , aaSorting: []

    });
    $('#dataTable4').DataTable({
        language: {
            // 'url' : 'https://cdn.datatables.net/plug-ins/1.10.16/i18n/French.json'
            // More languages : http://www.datatables.net/plug-ins/i18n/
        }
        , aaSorting: []
    });

</script>
@endpush
