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
        $packagePaginator = Package::category($id)->with(['reviews'])->whereHas('tickets')->latest('created_at')->paginate(10);
        return new PackageCollection($packagePaginator);
    }



    public function detail($id)
    {
        $package = Package::where(['id' => $id])->with('reviews')->firstOrFail();
        return new PackageDetailResource($package);
    }
}
