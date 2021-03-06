<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthInfoController;
use App\Http\Controllers\AuthController;

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

/**
 * public routes
 */
//認証系
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/**
 * protected routes
 */
//auth:webじゃないとAuth::logoutが使えない？
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:web');

Route::group(['middleware' => ['auth:sanctum']], function (){
  Route::get('auth/info', [AuthController::class, 'info']);
  Route::group(['prefix' => 'tasks'], function(): void {
    Route::get('index', [TaskController::class, 'index']);
    Route::post('update', [TaskController::class, 'update']);

    Route::get('search', [TaskController::class, 'search']);
    
  });
});

