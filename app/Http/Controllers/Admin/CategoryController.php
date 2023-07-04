<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $types = Type::all();
        return view('admin.category.index', ['categories' => $categories,'types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.category.create',['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type_id = $request->type_id;
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category)
    {
        return view('admin.category.edit', ['category' => $category,'types' => Type::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type_id = $request->type_id;
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category.index');
    }
}
