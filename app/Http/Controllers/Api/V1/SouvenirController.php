<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SouvenirCollection;
use App\Models\Destination;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function index(Request $request)
    {
    }

    public function destination(Destination $destination)
    {
        return new SouvenirCollection($destination->souvenirs()->available()->get());
    }
}
