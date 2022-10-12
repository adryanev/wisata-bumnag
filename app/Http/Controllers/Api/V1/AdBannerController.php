<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdBanner;
use App\Transformers\AdBannerTransformer;

class AdBannerController extends Controller
{
    public function index()
    {
        $banners = AdBanner::all();
        return fractal()->collection($banners)->transformWith(new AdBannerTransformer)->toArray();
    }
}
