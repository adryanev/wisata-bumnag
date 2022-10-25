<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationCollection;
use App\Models\Application;
use App\Transformers\ApplicationTransformer;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $application = Application::all();
        return new ApplicationCollection($application);
    }
}
