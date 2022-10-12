<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Transformers\DestinationTransformer;
use Illuminate\Http\Request;
use App\Models\Destination;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class DestinationController extends Controller
{
    public function index()
    {
        $destination = Destination::paginate(10);
        return fractal()
            ->collection($destination->getCollection())
            ->transformWith(new DestinationTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($destination))
            ->toArray();
    }
}
