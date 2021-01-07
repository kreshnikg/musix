<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api','role:customer'])->group(function() {

    Route::post('/subscribe','SubscriptionController@subscribe');

    Route::middleware('subscribed')->group(function () {
        Route::get('/home', 'SongController@latest');

        Route::get('/song/{song}', 'SongController@play');

        #region Favourites
        Route::get('/favourites', 'FavouritesController@index');
        Route::post('/favourites', 'FavouritesController@toggleSong');
        Route::post('/favourites/remove', 'FavouritesController@removeSong');
        #endregion

        #region Artists
        Route::get('/artists', 'ArtistController@index');
        #endregion

        #region TopSongs
        Route::get('/top-songs', 'SongController@topSongs');
        #endregion
    });
});
