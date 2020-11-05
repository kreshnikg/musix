<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api','role:customer'])->group(function() {

    Route::post('/subscribe','SubscriptionController@subscribe');

    Route::middleware('subscribed')->group(function () {

    });
});
