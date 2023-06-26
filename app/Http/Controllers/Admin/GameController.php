<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;

class GameController extends Controller
{
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
        $game->type_id = $request->type_id;
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
        $game->is_active = $request->is_active;
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
