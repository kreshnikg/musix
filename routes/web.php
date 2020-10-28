<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth',
    'consumer',
//    'subscribed'
])->group(function(){

});

Route::prefix('/dashboard')
    ->middleware([
        'auth',
        'manager'
    ])->namespace('Dashboard')->group(function() {

        Route::redirect("/", "/dashboard/statistics");

        Route::get("/statistics","StatisticController@index");
        Route::resource('/songs','SongController');
        Route::resource('/artists','ArtistController');
        Route::resource('/genres','GenreController');

        Route::middleware('admin')->group(function() {
            Route::resource('/users','UserController');
            Route::resource('/roles','RoleController');
            Route::resource('/subscriptions','SubscriptionController');
        });
});
