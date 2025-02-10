<?php

use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'Hello, World!']);
    });
});