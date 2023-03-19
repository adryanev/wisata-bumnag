<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use GuzzleHttp\Psr7\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryParent = null;
        $categoriesUnmapped = Category::all();
        $categories = $categoriesUnmapped->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $categories->prepend('No Parent', '0');
        return view('admin.categories.create', compact('categories', 'categoryParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        if ($data['category_parent'] == "0") {
            $data['parent_id'] = null;
        } else {
            $data['parent_id'] = (int) $data['category_parent'];
        }
        $category = Category::create($data);
        // dd($category);
        return back()->withSuccess('Success Create Category '.$category->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categoryParent = $category->parent;
        return view('admin.categories.show', compact('category', 'categoryParent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categoryParent = $category->parent;
        $categoriesUnmapped = Category::all();
        $categories = $categoriesUnmapped->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
        $categories->prepend('No Parent', '0');
        return view('admin.categories.edit', compact('category', 'categories', 'categoryParent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->all();
        if ($data['category_parent'] == 0) {
            $data['parent_id'] = null;
        } else {
            $data['parent_id'] = (int) $data['category_parent'];
        }
        $category->update($data);
        return redirect(route('admin.categories.index'))->withSuccess('Success Edit '.$category->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $category->delete();
        return back()->withSuccess('Success Delete '.$categoryName);
    }
}
