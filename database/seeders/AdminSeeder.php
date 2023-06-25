<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Game;
use App\Models\Type;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new Type;
        $type->code = 'Roleta';
        $type->save();

        $type2 = new Type;
        $type2->code = 'Crash';
        $type2->save();

        $category = new Category;
        $category->name = "Roleta";
        $category->description = "Roleta de 6 cores ! Escolha uma e tente a sorte!";
        $category->type_id = 1;
        $category->save();

        $category2 = new Category;
        $category2->name = "Crash";
        $category2->description = "Aposte e dobre seu dinheiro!";
        $category2->type_id = 2;
        $category2->save();

        $game = new Game;
        $game->name = "Roleta - 6 Números";
        $game->access_code = Str::uuid();
        $game->category_id = $category->id;
        $game->save();

        $game2 = new Game;
        $game2->name = "Crash";
        $game2->access_code = Str::uuid();
        $game2->category_id = $category2->id;
        $game2->save();
    }
}
