<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\TicketerCheckResource;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use App\Notifications\UserTicketApproved;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TicketerController extends Controller
{
    public function check(Request $request)
    {
        $data = $request->all();
        $order = Order::incomplete()
            ->where(['number' => $data['number'], 'order_date' => Carbon::parse($data['order_date'])])->firstOrFail();


        return new OrderResource($order);
    }
    public function payment(Request $request)
    {
        $body = $request->all();
        $order = Order::incomplete()->where(['number' => $body['order_number']])->firstOrFail();

        $carbon = Carbon::now();

        try {
            DB::beginTransaction();

            $payment = Payment::create([
                'order_id' => $order->id,
                'number' => "PAY/{$carbon->format('ymdhisu')}",
                'payment_create_date' => $carbon,
                'payment_status' => Payment::STATUS_SUCCESS,
                'total' => $order->total_price,
            ]);
            $order->status = ORDER::STATUS_PAID;
            $order->save();
            $order->payments()->save($payment);

            DB::commit();
            return response()->json(['data' => 'Order berhasil dibayar']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return response()->json(['errors' => ['message' => 'Cannot create payment data']]);
    }
    public function approve(Request $request)
    {
        $data = $request->all();
        $order = Order::incomplete()
            ->where(['number' => $data['number'], 'order_date' => Carbon::parse($data['order_date'])])
            ->firstOrFail();

        $order->status = Order::STATUS_COMPLETED;
        $order->save();

        $history = new OrderStatusHistory([

            'status' => Order::STATUS_COMPLETED,
            'description' => 'Tiket sudah digunakan',
        ]);
        $order->histories()->save($history);
        if (!empty($order->user->device_token)) {
            try {
                $order->user->notify(new UserTicketApproved($order));
            } catch (Exception $e) {
                $status = $e->getCode();
                $message = $e->getMessage();
                $data = $e->getTrace();
                $notice = ['status' => $status , 'message' => $message, 'data' => $data];
                Log::notice('Failed to Send Notification to Ticketer', $notice);
            }
        }

        return response()->json([
            'data' => 'Order Approved',
        ]);
    }
}
