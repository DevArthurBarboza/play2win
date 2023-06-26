<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "access_code",
        'multiplier',
        'is_active'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function render()
    {
        $category = Category::find($this->category_id);
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
}
