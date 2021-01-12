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

        Route::get('/songs/search', 'SongController@search');
        Route::get('/song/{song}', 'SongController@play');
        Route::get('/song/{song}/next', 'SongController@playNext');
        Route::get('/song/{song}/previous', 'SongController@playPrevious');

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

        #region Playlisys
        Route::get('/playlists', 'PlaylistController@index');
        Route::post('/playlists', 'PlaylistController@store');
        Route::post('/playlists/{playlist}/add-song', 'PlaylistController@addSong');
        Route::post('/playlists/{playlist}/remove-song', 'PlaylistController@removeSong');
        Route::get('/playlists/{playlist}', 'PlaylistController@show');
        Route::delete('/playlists/{playlist}', 'PlaylistController@destroy');
        #endregion
    });
});
