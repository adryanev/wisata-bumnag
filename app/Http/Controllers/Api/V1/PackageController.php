<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageCollection;
use App\Http\Resources\PackageDetailResource;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('category');
        $destinationPaginator = Package::category($id)->with(['reviews'])->whereHas('tickets')->paginate(10);
        return new PackageCollection($destinationPaginator);
    }



    public function detail($id)
    {
        $destination = Package::where(['id' => $id])->with('reviews')->first();
        return new PackageDetailResource($destination);
    }
}
