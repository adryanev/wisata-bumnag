<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = $user->notifications()->latest()->get();
        return view('admin.notifications.index', compact('user', 'notifications'));
    }
    public function read($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        if ($notification->read()) {
            return redirect(route('admin.orders.show', $notification->data['object_id']));
        }
        $notification->markAsRead();
        return redirect(route('admin.orders.show', $notification->data['object_id']));
    }
    public function readAll()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return back()->withSuccess('Readed All Notifications');
    }
}
