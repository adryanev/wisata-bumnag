<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatusHistory;
use App\Models\User;
use App\Notifications\AdminOrderCreated;
use App\Notifications\UserOrderCreated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\TemporaryDirectory\TemporaryDirectory;

use function Pest\Laravel\json;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(10);

        return new OrderCollection($orders);
    }

    public function store(Request $request)
    {

        $body = $request->all();

        $tempDir = (new TemporaryDirectory())->create();

        try {
            DB::beginTransaction();
            $now = now();
            $order_number = $now->format('ymdhisu');
            $note = "ORD/{$order_number}";
            $order_date = Carbon::parse($body['order_date']);
            $order = Order::create([
                'total_price' => $body['total_price'],
                'number' => $order_number,
                'note' => $note,
                'status' => Order::STATUS_CREATED,
                'user_id' => auth()->user()->id,
                'order_date' => $order_date,
            ]);
            $qr = QrCode::generate("${note};${order_date}", $tempDir->path("${order_number}.svg"));
            $order->addMedia($tempDir->path("${order_number}.svg"))->toMediacollection('QRCode');
            $history = new OrderStatusHistory([
                'status' => Order::STATUS_CREATED,
                'description' => 'Order berhasil dibuat',

            ]);
            $order->histories()->saveMany([$history]);
            $details = [];
            foreach ($body['order_details'] as $key => $value) {
                $details[] = new OrderDetail(array_merge($value));
            }
            $order->orderDetails()->saveMany($details);
            if (!empty($order->user->device_token)) {
                $order->user->notify(new UserOrderCreated($order));
            }
            $notification_e = [];
            try {
                $adminId = $order->orderDetails->first()->orderable->created_by;
                User::find($adminId)->notify(new AdminOrderCreated($order));
            } catch (Exception $e) {
                $notification_e["status"] = $e->getCode();
                $notification_e["message"] = $e->getMessage();
                $notification_e["data"] = $e->getTrace();
                $notice = ['status' => $notification_e["status"] , 'message' => $notification_e["message"], 'data' => $notification_e["data"]];
                Log::notice('Failed to Send Notification', $notice);
            }
            DB::commit();
            $tempDir->delete();
            return new OrderResource($order);
        } catch (Exception $e) {
            $tempDir->delete();
            DB::rollBack();
        }

        return response()->json(['errors' => ['message' => 'Cannot create order']], 500);
    }
}
