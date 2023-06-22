<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
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
            return view('game.roleta',['user' => Auth::user()]);
        }
        if($type->code == "Crash"){
            return view('game.crash',['user' => Auth::user()]);
        }
        if($type->code == "Roleta"){
            return view('game.roleta',['user' => Auth::user()]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
