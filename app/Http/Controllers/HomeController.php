<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $games = Game::where('is_active',1)->get();
        return view("user.home",['categories' => $categories, 'games' => $games]);
    }

}
