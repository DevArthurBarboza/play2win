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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->boolean('is_active')->default(false)->nullable();
            $table->uuid('access_code');
            $table->float('multiplier',6,3)->default(1.0);
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('categories',function (Blueprint $table){
            $table->dropForeign('categories_game_id_foreign');
        });

        Schema::dropIfExists('games');
    }
};
