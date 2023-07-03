<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/routes', [RouteController::class, 'index']);
Route::get('/routes/show/{id}', [RouteController::class, 'show']);
// Route::get('/routes/search/{name}', [ProuductController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/routes/add', [RouteController::class, 'store']);
    Route::post('/routes/update/{id}', [RouteController::class, 'update']);
    Route::delete('/routes/delete/{id}', [RouteController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

