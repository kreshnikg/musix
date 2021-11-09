<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('artist_id');
            $table->unsignedInteger('genre_id');
            $table->timestamps();

            $table->foreign('artist_id')
                ->references('artist_id')
                ->on('artist')
                ->onDelete('cascade');

            $table->foreign('genre_id')
                ->references('genre_id')
                ->on('genre')
                ->onDelete('cascade');

            $table->unique(['artist_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_genre');
    }
}
