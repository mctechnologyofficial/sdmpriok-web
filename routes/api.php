<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TeamController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout');
    });
});

// Profile Users
Route::prefix('user/profile')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('update/{user_hash}', 'update');
    });
});

// Todo employee routes 
Route::prefix('employee')->group(function () {
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/show/{user_hash}', 'show');
        Route::post('/store', 'store');
        Route::post('update/{user_hash}', 'update');
        Route::post('delete/{user_hash}', 'delete');
    });
});

// Todo Roles Routes
Route::prefix('role')->group(function () {
    Route::controller(RoleController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::post('/update/{id}', 'update');
        Route::post('/delete/{id}', 'delete');
    });
});

// Todo Team Routes
Route::prefix('team')->group(function () {
    Route::controller(TeamController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::post('/update/{id}', 'update');
        Route::post('/delete/{id}', 'delete');
    });
});

