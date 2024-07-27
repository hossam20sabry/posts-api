<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
],
function ($router) {
    Route::post('register', 'App\Http\Controllers\api\AuthController@register');
    Route::post('login', 'App\Http\Controllers\api\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\api\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\api\AuthController@refresh');
    Route::get('user-profile', 'App\Http\Controllers\api\AuthController@userProfile');
});


Route::middleware('jwt.verify')->group(function () {
    Route::get('/posts', [App\Http\Controllers\api\PostsController::class, 'index']);
    Route::get('/post/{id}', [App\Http\Controllers\api\PostsController::class, 'show']);
    Route::post('/posts', [App\Http\Controllers\api\PostsController::class, 'store']);
    Route::post('/post/{id}', [App\Http\Controllers\api\PostsController::class, 'update']);
    Route::post('/post/delete/{id}', [App\Http\Controllers\api\PostsController::class, 'destroy']);
});
