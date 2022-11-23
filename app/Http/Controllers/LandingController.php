<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDO;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.default');
    }
}
