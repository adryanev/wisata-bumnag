<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Event;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalDestination = Destination::count();
        $totalPackage = Package::count();
        $totalEvent = Event::count();
        return view('admin.dashboard.index', compact(
            'totalUser',
            'totalDestination',
            'totalPackage',
            'totalEvent',
        ));
    }
}
