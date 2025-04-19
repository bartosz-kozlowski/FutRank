<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('player_id')->constrained()->onDelete('cascade');
        $table->tinyInteger('rating'); // 1–5
        $table->text('comment')->nullable();
        $table->string('sentiment')->nullable(); // np. positive / neutral / negative
        $table->timestamps();

        $table->unique(['user_id', 'player_id']); // tylko jedna ocena na gracza
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
