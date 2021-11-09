<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('song_id');
            $table->unsignedInteger('genre_id');
            $table->timestamps();

            $table->foreign('song_id')
                ->references('song_id')
                ->on('song')
                ->onDelete('cascade');

            $table->foreign('genre_id')
                ->references('genre_id')
                ->on('genre')
                ->onDelete('cascade');

            $table->unique(['song_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_genre');
    }
}
