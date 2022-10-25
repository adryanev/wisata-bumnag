<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function main()
    {
        $category = Category::getRoots();
        return new CategoryCollection($category);
    }

    public function child(Request $request)
    {
        $parent = $request->get('parent');

        $category = Category::where(['id' => $parent])->first();
        return new CategoryCollection($category->getChildren());
    }
}
