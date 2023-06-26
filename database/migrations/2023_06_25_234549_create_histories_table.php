<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');
            $table->boolean('won');
            $table->float('bet_amount',8,2);
            $table->float('new_cash',8,2);
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users',function (Blueprint $table){
            $table->dropForeign('users_histories_id_foreign');
        });

        Schema::table('games',function (Blueprint $table){
            $table->dropForeign('games_histories_id_foreign');
        });

        Schema::dropIfExists('histories');
    }
};
