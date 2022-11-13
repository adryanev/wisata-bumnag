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
        $totalUser = count(User::all());
        $totalDestination = count(Destination::all());
        $totalPackage = count(Package::all());
        $totalEvent = count(Event::all());
        return view('admin.dashboard.index', compact(
            'totalUser',
            'totalDestination',
            'totalPackage',
            'totalEvent',
        ));
    }
}
