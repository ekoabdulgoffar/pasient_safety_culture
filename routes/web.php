<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\UserKuesionerController;

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

Route::get('/', function () {
    return view('login');
});

Route::resource('/Dashboard', 'HomeController');

Route::resource('/login', 'LoginController');
Route::get('/page_logout', [LoginController::class, 'page_logout']);
Route::post('/login', [LoginController::class, 'ceklogin']);
Route::post('/register', [LoginController::class, 'register']);

// history kuesioner

Route::resource('/history_kuesioner', 'HistoryKuesionerController');

// end history kuesioner


// USER
Route::resource('/user-dashboard', 'HomeUserController');
