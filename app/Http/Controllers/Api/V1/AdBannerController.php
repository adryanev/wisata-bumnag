<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdBannerCollection;
use Illuminate\Http\Request;
use App\Models\AdBanner;
use App\Transformers\AdBannerTransformer;

class AdBannerController extends Controller
{
    public function index()
    {
        $banners = AdBanner::limit(10)->get();
        return new AdBannerCollection($banners);
    }
}
