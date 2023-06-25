<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use App\Models\Game;
use App\Http\Controllers\Controller;

class DebugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dumpGame()
    {
        dd(Game::get());
    }

    public function dumpCategory()
    {
        dd(Category::get());
    }

    public function dumpType()
    {
        dd(Type::get());
    }
}
