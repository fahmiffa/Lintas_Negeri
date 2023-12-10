<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'sign'])->name('sign');
Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('home');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {
    
    Route::group(['prefix'=>'dashboard'],function() {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
        Route::post('account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::resource('class', App\Http\Controllers\KelasController::class);

        // participant
        Route::get('kelas', [App\Http\Controllers\Participant::class, 'class'])->name('kelas');
    });
});