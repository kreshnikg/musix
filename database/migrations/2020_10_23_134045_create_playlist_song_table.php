<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_song', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('playlist_id');
            $table->unsignedInteger('song_id');
            $table->timestamps();

            $table->foreign('playlist_id')
                ->references('playlist_id')
                ->on('playlist')
                ->onDelete('cascade');

            $table->foreign('song_id')
                ->references('song_id')
                ->on('song')
                ->onDelete('cascade');

            $table->unique(['playlist_id', 'song_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_song');
    }
}
