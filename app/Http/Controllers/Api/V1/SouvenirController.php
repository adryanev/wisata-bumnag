<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationSouvenirCollection;
use App\Http\Resources\SouvenirCollection;
use App\Models\Destination;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function index()
    {
        $data = Destination::whereHas('souvenirs')->paginate();
        return new DestinationSouvenirCollection($data);
    }

    public function destination(Destination $destination)
    {
        return new SouvenirCollection($destination->souvenirs()->joinRelationship('categories')->available()->get());
    }
}
