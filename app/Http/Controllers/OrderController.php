<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\AdminOrderCancelled;
use App\Notifications\AdminOrderPaid;
use App\Notifications\AdminOrderRefunded;
use App\Notifications\UserOrderCancelled;
use App\Notifications\UserOrderRefunded;
use App\Notifications\UserPaymentReceived;
use App\Notifications\UserTicketApproved;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::getUser()->roles->first()->name == 'admin') {
            $itemss = Order::latest('updated_at')->get();
            $orders = [];
            foreach ($itemss as $item) {
                if ($item->orderDetails->first()->orderable_type::where([
                    'id' => $item->orderDetails->first()->orderable_id,
                    'created_by' => Auth::user()->id,
                ])->count() != 0) {
                    array_push($orders, $item);
                }
            }
        } elseif (Auth::getUser()->roles->first()->name == 'super-admin') {
             $orders = Order::latest('updated_at')->get();
        }
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $orderDetail = $order->orderDetails;
        $orderHistories = $order->histories;
        return view('admin.orders.show', compact('order', 'orderDetail', 'orderHistories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->histories()->delete();
        $order->delete();
        return back()->withSuccess('Success Delete Order');
    }
    public function paid($id)
    {
        $order = Order::find($id);
        if ($order->status > 0) {
            back()->withErrors(['message' => 'Order already paid']);
        }
        $carbon = Carbon::now();
        try {
            DB::beginTransaction();
            $payment = Payment::create([
                'order_id' => $order->id,
                'number' => "PAY/{$carbon->format('ymdhisu')}",
                'payment_create_date' => $carbon,
                'payment_status' => Payment::STATUS_SUCCESS,
                'total' => $order->total_price,
                'payment_type' => 'cash',
            ]);
            $order->payments()->save($payment);

            $history = new OrderStatusHistory([
                'status' => Order::STATUS_PAID,
                'description' => 'Pembayaran sudah diterima',
            ]);
            $order->histories()->saveMany([$history]);
            $order->status = Order::STATUS_PAID;
            $order->save();

            $payment->total_paid = $order->total_price;
            $payment->payment_update_date = now();

            foreach ($order->orderDetails as $orderDetail) {
                    $orderable = $orderDetail->orderable;
                if ($orderable->quantity > 0 && $orderable->quantity >= $orderDetail->quantity) {
                    $orderable->quantity -= $orderDetail->quantity;
                    $orderable->save();
                } else {
                    DB::rollBack();
                    throw new Exception('Quantity of '.$orderable->name.' not enough... '.' Quantity: '.$orderable->quantity.' Ordered: '.$orderDetail->quantity);
                }
            }
            //send notification
            $order->user->notify(new UserPaymentReceived($order));
            $adminId = $order->orderDetails->first()->orderable->created_by;
            User::find($adminId)->notify(new AdminOrderPaid($order));
            DB::commit();
            return back()->withSuccess('Success Update Order');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $history = new OrderStatusHistory([
            'status' => Order::STATUS_CANCELLED,
            'description' => 'Order telah dibatalkan',
        ]);
        $order->histories()->saveMany([$history]);
        $order->status = Order::STATUS_CANCELLED;
        $order->save();
        //send notification
        $order->user->notify(new UserOrderCancelled($order));
        $adminId = $order->orderDetails->first()->orderable->created_by;
        User::find($adminId)->notify(new AdminOrderCancelled($order));
        return back()->withSuccess('Success Update Order');
    }
    public function complete($id)
    {
        $order = Order::find($id);
        $history = new OrderStatusHistory([
            'status' => Order::STATUS_COMPLETED,
            'description' => 'Order telah diselesaikan',
        ]);
        $order->histories()->saveMany([$history]);
        $order->status = Order::STATUS_COMPLETED;
        $order->save();
         //send notification
        $order->user->notify(new UserTicketApproved($order));
        return back()->withSuccess('Success Update Order');
    }
    public function refund($id)
    {
        $order = Order::find($id);
        $history = new OrderStatusHistory([
            'status' => Order::STATUS_REFUNDED,
            'description' => 'Order telah diselesaikan',
        ]);
        $order->histories()->saveMany([$history]);
        $order->status = Order::STATUS_REFUNDED;
        $order->save();
         //send notification
        $order->user->notify(new UserOrderRefunded($order));
        $adminId = $order->orderDetails->first()->orderable->created_by;
        User::find($adminId)->notify(new AdminOrderRefunded($order));
        return back()->withSuccess('Success Update Order');
    }
}
