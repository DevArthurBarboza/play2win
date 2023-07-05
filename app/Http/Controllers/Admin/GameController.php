<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Support\Str;
use App\Models\Category;

class GameController extends Controller
{


    public function create(){

        return view("admin.game.create",['categories' => Category::all()]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view('admin.game.index',['games' => $games]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $game = new Game();
        $game->name = $request->name;
        $game->multiplier = $request->multiplier;
        $game->category_id = $request->category;
        $game->access_code = Str::uuid();
        $game->save();
        return redirect()->route('games.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.game.edit', ['game' => Game::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $game = Game::find($id);
        $game->name = $request->name;
        $game->multiplier = $request->multiplier;
        if($request->is_active){
            $game->is_active = true;
        }else{
            $game->is_active = false;
        }
        $game->save();
        return redirect()->route('games.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Game::destroy($id);
        return redirect()->route('games.index');
    }
}
