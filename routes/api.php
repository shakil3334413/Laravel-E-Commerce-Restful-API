<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products',ProductController::class);
Route::group(['prefix'=>'products'],function(){
    Route::apiResource('{product}/reviews',ReviewController::class);
});