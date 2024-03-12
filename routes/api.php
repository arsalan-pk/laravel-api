<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Feedback\FeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('user-login',[AuthController::class,'login']);
Route::get('search-feedback',[FeedbackController::class,'search']);
// Route::get('search-feedback','search');


Route::middleware(['auth:sanctum'])->group( function () {
    Route::post('user-logout',[AuthController::class,'logout']);

    Route::controller(FeedbackController::class)->group(function (){
        Route::get('index-feedback','index');
        Route::post('store-feedback','store');
        Route::get('show-feedback/{id}','show');
        Route::put('update-feedback/{id}','update');
        Route::delete('delete-feedback/{id}','destroy');
    });

});
