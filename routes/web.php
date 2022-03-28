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

Route::resource('/user-kuesioner', 'HistoryKuesionerController');

// end history kuesioner


// USER
Route::resource('/user-dashboard', 'HomeUserController');

// USER KUESIONER

Route::get('/user-kuesioner', [UserKuesionerController::class, 'index']);
Route::get('/user-kuesioner-kuesioner', [UserKuesionerController::class, 'historyKuesioner']);

    // ISI KUESIONER
    Route::get('/user-kuesioner/isi/{id}', [UserKuesionerController::class, 'goto_isi_kuesioner_page']);
    Route::get('/user-kuesioner/detail/{id}', [UserKuesionerController::class, 'detaikKuesioner2']);
    Route::get('/user-kuesioner/edit/{id}', [UserKuesionerController::class, 'editKuesioner']);
        
    Route::post('/isi-kuesioner', [UserKuesionerController::class, 'submitKuesioner']);

    // END ISI KUESIONER
   
// END USER
