<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Transformers\ApplicationTransformer;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $application = Application::where(['id' => 4]);
        return fractal()->collection($application)->transformWith(new ApplicationTransformer)->toArray();
    }
}
