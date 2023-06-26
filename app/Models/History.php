<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $_fillable = [
        'user_id',
        'game_id',
        'won',
        'bet_amount',
    ];
}
