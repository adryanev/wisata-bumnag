<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationCollection;
use Illuminate\Http\Request;
use App\Models\Destination;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('category');
        $destinationPaginator = Destination::category($id)->with(['reviews', 'tickets'])->paginate(10);
        return new DestinationCollection($destinationPaginator);

        // $destionation = QueryBuilder::for(Destination::class)
        //     ->with(['categories'])
        //     ->allowedFilters([AllowedFilter::scope()])
        //     ->paginate()
        //     ->appends($request->query());
        // return $destionation;
    }

    public function detail(Request $request){

    }
}
