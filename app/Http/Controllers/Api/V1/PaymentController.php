<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Midtrans\Facades\Midtrans;
use App\Services\Midtrans\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        $carbon = Carbon::now();

        try {
            DB::beginTransaction();

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
        }
    }

    public function notification(Request $request)
    {
        $midtransNotification = Midtrans::notification();
        $notification = $midtransNotification->toObject();
        $verified = $this->verifyNotification($midtransNotification);
        if ($verified) {
            $notifTransactionStatus = $notification->transaction_status;
            $fraud = $notification->fraud_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $amount = $notification->gross_amount;

            $transaction = Order::where('note', $orderId)->first();

            $payment = Payment::where('transaction_code', $transaction->code)->first();
            $decode = json_encode($notification);

            $payment->payload = $decode;

            if (!empty($notification->va_numbers[0])) {
                $payment->va = $notification->va_numbers[0]->va_number;
                $payment->bank = $notification->va_numbers[0]->bank;
            }
            if (!empty($notification->biller_code) || !empty($notification->bill_key)) {
                $payment->biller_code = $notification->biller_code;
                $payment->bill_key = $notification->bill_key;
            }
            if ($notifTransactionStatus == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        $payment->status = Payment::STATUS_CHALLENGED;
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        $payment->status = Payment::STATUS_SUCCESS;
                    }
                }
            } elseif ($notifTransactionStatus == 'settlement') {
                // TODO set payment status in merchant's database to 'Settlement'
                $payment->status = Payment::STATUS_SETTLEMENT;
            } elseif ($notifTransactionStatus == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                $payment->status = Payment::STATUS_PENDING;
            } elseif ($notifTransactionStatus == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                $payment->status = Payment::STATUS_DENY;
            } elseif ($notifTransactionStatus == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $payment->status = Payment::STATUS_EXPIRE;
            } elseif ($notifTransactionStatus == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                $payment->status = Payment::STATUS_CANCEL;
            }

            // DB::transaction(function () use ($payment, $transaction) {
            //     $payment->save();
            //     if ($payment->status === Payment::STATUS_SETTLEMENT || $payment->status === Payment::STATUS_SUCCESS) {
            //         $transaction->payment_status = Transaction::PAYMENT_STATUS_PAID;
            //         $transaction->status = Transaction::STATUS_CONFIRMED;
            //         TransactionHistory::create([
            //             'transaction_id' => $transaction->id,
            //             'status' => Transaction::STATUS_CONFIRMED
            //         ]);
            //     }
            //     $transaction->save();
            //     // PaymentConfirmed::dispatch($payment);
            // });
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
}
