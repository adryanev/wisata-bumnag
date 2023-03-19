@extends('admin.default')

@section('page-header')
Orders {{ $order->id }} <small><i class="c-white-500 ti-eye"></i></small>

@endsection

@section('content')
<div class="conatainer bgc-white p-20">
    <div class="table-responsive">
        <table class="table align-item-center mb-0">
            <tr>
                <td>Number</td>
                <td>{{ $order->number }}</td>
            </tr>
            <tr>
                <td>Note</td>
                <td>{{ $order->note }}</td>
            </tr>
            <tr>
                <td>Status</td>
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
                    Compeleted
                    @break
                    @case(4)
                    Refunded
                    @break
                    @default
                    {{ $order->status }}
                    @endswitch
                </td>
            </tr>
            <tr>
                <td>
                    User ID
                    <br>
                    Nama
                </td>
                <td>
                    {{ $order->user->id }}
                    <br>
                    {{ $order->user->name }}
                </td>
            </tr>
            <tr>
                <td>Order Date</td>
                <td>{{ $order->order_date }}</td>
            </tr>
            <tr>
                <td>Total Price</td>
                <td>{{ $order->total_price }}</td>
            </tr>
            <tr>
                <td>Payment Type</td>
                <td>{{ $order->payment_type }}</td>
            </tr>
        </table>
    </div>
</div>
<br>
<div class="conatainer bgc-white p-20">
    <h5>Order Details</h5>
</div>
@foreach ($orderDetail as $detail)
<div class="conatainer bgc-white p-20">
    <div class="table-responsive">
        <br>
        <table class="table align-item-center mb-0">
            <tr>
                <td>Orderable Type</td>
                <td>{{ $detail->orderable_type }}</td>
            </tr>
            <tr>
                <td>Orderable Name</td>
                <td>{{ $detail->orderable_name }}</td>
            </tr>
            <tr>
                <td>Orderable Price</td>
                <td>{{ $detail->orderable_price }}</td>
            </tr>
            <tr>
                <td>Sub Total</td>
                <td>{{ $detail->subtotal }}</td>
            </tr>
        </table>
        <br>
    </div>
</div>
@endforeach


<br>
<div class="conatainer bgc-white p-20">
    <div class="table-responsive">
        <h5>Order Status Histories</h5>
        <table class="table align-item-center mb-0">
            <thead>
                <th>ID</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Description</th>
            </thead>
            @foreach ($orderHistories as $histories)
            <tr>
                <td>{{ $histories->id }}</td>
                <td>{{ $histories->order_id }}</td>
                <td>
                    @switch($histories->status)
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
                    Compeleted
                    @break
                    @case(4)
                    Refunded
                    @break
                    @default
                    {{ $histories->status }}
                    @endswitch
                </td>
                <td>{{ $histories->description }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>



@endsection
