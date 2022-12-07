<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecommendationCollection;
use App\Http\Resources\RecommendationResource;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {

        $recommendation = Recommendation::with('destination')->orderBy('rank', 'ASC')->limit(10)->get();
        return new RecommendationCollection($recommendation);
    }
}
