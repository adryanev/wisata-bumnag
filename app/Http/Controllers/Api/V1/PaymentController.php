<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\PaymentReceived;
use App\Services\Midtrans\Facades\Midtrans;
use App\Services\Midtrans\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $body = $request->all();
        $user = auth()->user();
        $order = Order::where(['number' => $body['order_number']])->first();

        $carbon = Carbon::now();

        try {
            DB::beginTransaction();

            $payment = new Payment([
                'payment_create_date' => $carbon,
                'payment_status' => Payment::STATUS_PENDING,
                'total' => $order->total_price,
            ]);
            $order->payments()->save($payment);

            $items = $this->setupDetailOrder($order);
            $snapPayload = $this->setupSnapPayload($order, $items, $user);

            $snap = Midtrans::createTransaction($snapPayload);
            $payment->payment_token = $snap->token;
            $payment->payment_url = $snap->url;
            $payment->save();

            DB::commit();
            return response()->json(['url' => $snap->url, 'token' => $snap->token]);
        } catch (Exception $e) {
            DB::rollBack();
        }
        return response()->json(['errors' => ['message' => 'Cannot create payment data']]);
    }

    public function notification()
    {
        $midtransNotification = Midtrans::notification();
        $notification = $midtransNotification->toObject();
        $verified = $this->verifyNotification($midtransNotification);
        if (!$verified) {
            return response()->json('Invalid Signature', 500);
        }
        $notifTransactionStatus = $notification->transaction_status;
        $fraud = $notification->fraud_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $amount = $notification->gross_amount;

        $transaction = Order::where('note', $orderId)->first();
        $user = $transaction->user;

        $payment = Payment::where('transaction_code', $transaction->code)->first();
        $decode = json_encode($notification);

        $payment->payment_payload = $decode;
        $payment->payment_update_date = now();

        if ($notifTransactionStatus == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $payment->payment_status = Payment::STATUS_CHALLENGED;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $payment->payment_status = Payment::STATUS_SUCCESS;
                }
            }
        } elseif ($notifTransactionStatus == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $payment->payment_status = Payment::STATUS_SETTLEMENT;
        } elseif ($notifTransactionStatus == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $payment->payment_status = Payment::STATUS_PENDING;
        } elseif ($notifTransactionStatus == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $payment->payment_status = Payment::STATUS_DENY;
        } elseif ($notifTransactionStatus == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $payment->payment_status = Payment::STATUS_EXPIRE;
        } elseif ($notifTransactionStatus == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $payment->payment_status = Payment::STATUS_CANCEL;
        }


        try {
            DB::beginTransaction();
            if ($payment->payment_status === Payment::STATUS_SETTLEMENT || $payment->payment_status === Payment::STATUS_SUCCESS) {
                $transaction->status = Order::STATUS_PAID;
                OrderStatusHistory::create([
                    'status' => Order::STATUS_PAID,
                    'description' => 'Pembayaran sudah diterima',
                ]);
                $payment->save();

                $transaction->save();
                DB::commit();

                if (!empty($user->device_token)) {
                    $user->notify(new PaymentReceived);
                }

                return response()->json(['message' => 'success']);
            }


            $payment->save();
            DB::commit();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    private function verifyNotification(Notification $notification)
    {
        $orderId = $notification->order_id;
        $statusCode = $notification->status_code;
        $grossAmount = $notification->gross_amount;
        $serverKey = config('midtrans.server_key');
        $hash = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
        return $notification->signature_key == $hash;
    }

    private function setupDetailOrder(Order $order)
    {
        $items = [];
        $details = $order->orderDetails;
        foreach ($details as $key => $item) {
            $items[] = [
                'id' => $item->orderable_id,
                'price' => $item->orderable_price,
                'quantity' => $item->quantity,
                'name' => $item->orderable_name,
            ];
        }
        return $items;
    }

    private function setupSnapPayload(Order $order, array $items, User $user)
    {
        $transactionDetail = [
            'order_id' => $order->number,
            'gross_amount' => $order->total_price,
        ];
        $billingAddress = [
            'name' => $user->name,
            'country_code' => 'IDN',
        ];
        $customerDetail = [
            'name' => $user->na,
            'last_name' => $user->profile->nama_belakang,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'billing_address' => $billingAddress,
            'shipping_address' => $billingAddress,
        ];

        $snapPayload = [
            'enable_payments' => Payment::PAYMENT_CHANNELS,
            'transaction_details' => $transactionDetail,
            'customer_details' => $customerDetail,
            'item_details' => $items,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => 'DAY',
                'duration' => 1,
            ],
        ];

        return $snapPayload;
    }
}