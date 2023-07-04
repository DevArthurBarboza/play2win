<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;
use App\Models\Category;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $game = Game::find($id);

        $category = Category::find($game->category_id);
        $type = Type::find($category->type_id);
        if($type->code == "Roleta"){
            return view('game.roleta',['user' => Auth::user(),'game' => $game]);
        }
        if($type->code == "Crash"){
            return view('game.crash',['user' => Auth::user(),'game' => $game]);
        }
    }


}
