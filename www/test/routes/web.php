<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test2', function () {
    return view('welcome');
});


Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']);
Route::get('user/add/{username}', [\App\Http\Controllers\UserController::class, 'add']);
Route::get('user/disable/{username}', [\App\Http\Controllers\UserController::class, 'disable']);
Route::get('user/del/{username}', [\App\Http\Controllers\UserController::class, 'del']);
Route::get('user/getList', [\App\Http\Controllers\UserController::class, 'getList']);
Route::get('user/offline', [\App\Http\Controllers\UserController::class, 'offline']);
