<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/subscribe','SubscriptionController@index');

    Route::middleware([
        'role:consumer',
        'subscribed'
    ])->group(function(){

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


