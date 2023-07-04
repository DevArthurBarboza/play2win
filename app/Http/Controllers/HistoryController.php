<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;

class HistoryController extends Controller
{
    
    public function show()
    {
        $history = History::where('user_id',Auth::id())->get();
        $games = Game::all();
        $gamesPlayed = Array();
        foreach($history as $match){
            if($match->game_id == $games[$match->game_id - 1]->id){
                $gamesPlayed[] = $games[$match->game_id - 1];
            }
        }

        return view('user.account.history',['history' => $history, 'games' => $gamesPlayed]);
    }
}
