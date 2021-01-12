<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/subscribe','HomeController@index');

    Route::middleware([
        'role:customer',
        'subscribed'
    ])->group(function(){
        $mainView = 'HomeController@mainView';

        Route::get('/browse', $mainView);
        Route::get('/favourites', $mainView);
        Route::get('/artists', $mainView);
        Route::get('/top-songs', $mainView);
        Route::get('/playlists', $mainView);
        Route::get('/playlists/{playlist}', $mainView);
    });

    Route::prefix('/dashboard')
        ->middleware('role:admin|manager')
        ->namespace('Dashboard')->group(function() {

        Route::redirect("/", "/dashboard/statistics");

        Route::get("/statistics","StatisticController@index");
        Route::resource('/songs','SongController');
        Route::resource('/artists','ArtistController');
        Route::resource('/genres','GenreController');

        Route::middleware('role:admin')->group(function() {
            Route::resource('/users','UserController');
            Route::resource('/roles','RoleController');
            Route::resource('/subscriptions','SubscriptionController');
        });
    });
});


