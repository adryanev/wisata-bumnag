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
    public function termAndConditions()
    {
        $websiteName = config('app.name');
        $companyName = env('APP_COMPANY_NAME');
        $websiteUrl = config('app.url');
        return view('landing.term-and-conditions', compact('websiteName', 'companyName', 'websiteUrl'));
    }
    public function privacyPolicy()
    {
        $websiteName = config('app.name');
        $companyName = env('APP_COMPANY_NAME');
        $websiteUrl = config('app.url');
        return view('landing.privacy-policy', compact('websiteName', 'companyName', 'websiteUrl'));
    }
}
