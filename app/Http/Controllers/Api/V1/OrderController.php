<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatusHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders;
        return OrderCollection::collection($orders);
    }

    public function store(Request $request)
    {

        $body = $request->all();
        try {
            DB::beginTransaction();
            $now = now();
            $order_number = $now->format('ymdhisu');
            $note = "ORD/{$order_number}";
            $order = Order::create([
                'total_price' => $body['total_price'],
                'number' => $order_number,
                'note' => $note,
                'status' => Order::STATUS_CREATED,
                'user_id' => auth()->user()->id,
                'order_date' => $now,
                'order_update_date' => $now,
            ]);
            $history = OrderStatusHistory::create([
                'status' => Order::STATUS_CREATED,
                'description' => 'Order berhasil dibuat',

            ]);
            $order->histories()->create($history);
            $details = [];
            foreach ($body['order_details'] as $key => $value) {
                $details[] = new OrderDetail(array_merge($value));
            }
            $order->orderDetail()->saveMany($details);
            DB::commit();
            return new OrderResource($order);
        } catch (Exception $e) {
            DB::rollBack();
        }

        return response()->json('Cannot create order', 500);
    }
}
