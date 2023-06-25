<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::find($id);
        return view('user.category.game',['games' => $category->games]);
    }
}
