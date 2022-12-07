<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Auth::user()->notifications()->limit(10)->latest()->get();
        return NotificationResource::collection($notification);
    }

    public function paginate()
    {
        $notification = Auth::user()->notifications()->latest()->paginate(10);
        return NotificationResource::collection($notification);
    }

    public function read(Request $request)
    {
        $req = $request->all();
        $notification = Auth::user()->notifications()->findOrFail($req['id']);
        $notification->markAsRead();
        return response()->json(['data' => 'NOTIFICATION_READ']);
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return response()->json(['data' => 'NOTIFICATION_READ']);
    }

    public function delete()
    {
        Auth::user()->notifications()->delete();
        return response()->json(['data' => 'NOTIFICATION_DELETED']);
    }
}
