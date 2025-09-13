<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\AuthController;

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
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:api'); // token login

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/blogs', [BlogApiController::class, 'index']);
    Route::get('/blog/{id}', [BlogApiController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']); // optional logout
});