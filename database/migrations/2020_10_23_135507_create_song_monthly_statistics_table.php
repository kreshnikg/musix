<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongMonthlyStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_monthly_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('song_id');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedInteger('play_count');
            $table->unsignedInteger('unique_user_count');
            $table->timestamps();

            $table->foreign('song_id')
                ->references('song_id')
                ->on('song')
                ->onDelete('cascade');

            $table->unique(['song_id', 'year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_monthly_statistics');
    }
}
