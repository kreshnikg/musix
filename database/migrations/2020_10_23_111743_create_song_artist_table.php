<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongArtistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_artist', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('song_id');
            $table->unsignedInteger('artist_id');
            $table->timestamps();

            $table->foreign('song_id')
                ->references('song_id')
                ->on('song')
                ->onDelete('cascade');

            $table->foreign('artist_id')
                ->references('artist_id')
                ->on('artist')
                ->onDelete('cascade');

            $table->unique(['song_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_artist');
    }
}
