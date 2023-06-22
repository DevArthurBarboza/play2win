<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id'
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function types(): HasOne
    {
        return $this->hasOne(Type::class);
    }
}
