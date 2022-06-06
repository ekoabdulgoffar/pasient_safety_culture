<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\UserKuesionerController;
use App\Http\Controllers\PostTestController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\UserPostController;
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

Route::resource('/', 'LandingController');

Route::get('/login', function () {
    return view('login');
});

Route::resource('/Dashboard', 'HomeController');

Route::resource('/login', 'LoginController');
Route::get('/page_logout', [LoginController::class, 'page_logout']);
Route::post('/login', [LoginController::class, 'ceklogin']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/user_update_password', [UserController::class, 'updatePassword']);
Route::get('/page_profile/{id}', [UserController::class, 'page_profile']);
Route::post('/page_profile/update', [UserController::class, 'updateProfile']);
// history kuesioner

Route::resource('/history_kuesioner', 'HistoryKuesionerController');

// end history kuesioner

//-- Start User
Route::resource('/management_of_user', 'UserController');
Route::post('/management_of_user/user_insert', [UserController::class, 'insert_user']);
Route::post('/management_of_user/user_update', [UserController::class, 'update_user']);
Route::post('/management_of_user/user_update_status', [UserController::class, 'updateStatus']);
Route::post('/management_of_user/reset_password', [UserController::class, 'resetPassword']);
Route::get('/distribution_of_user', [UserController::class, 'user_distribution']);
Route::get('/distribution_of_user/detail/{id}', [UserController::class, 'user_distribution_detail']);
//-- End User

//-- Start file edukasi
Route::resource('/management_of_education', 'EdukasiController');
Route::post('/management_of_education/education_insert', [EdukasiController::class, 'insert_education']);
Route::post('/management_of_education/education_update', [EdukasiController::class, 'update_education']);
Route::post('/management_of_education/education_delete', [EdukasiController::class, 'delete_education']);
//-- End file edukasi

// USER
// USER
Route::resource('/user-dashboard', 'HomeUserController');
Route::resource('/user-introduction','IntroductionController');
// USER KUESIONER

Route::get('/user-kuesioner', [UserKuesionerController::class, 'index']);

// ISI KUESIONER
Route::get('/user-kuesioner/isi/{id}', [UserKuesionerController::class, 'goto_isi_kuesioner_page']);
Route::get('/user-kuesioner/detail/{id}', [UserKuesionerController::class, 'detaikKuesioner2']);
Route::get('/user-kuesioner/edit/{id}', [UserKuesionerController::class, 'editKuesioner']);
    
Route::post('/isi-kuesioner', [UserKuesionerController::class, 'submitKuesioner']);
Route::get('/result-kuesioner', [UserKuesionerController::class, 'result']);

// END ISI KUESIONER

// PEMBELAJARAN
Route::resource('/pembelajaran','PembelajaranController');
Route::post('/update-pembelajaran/{id}', [PembelajaranController::class, 'updatePembelajaran']);
// END PEMBELAJARAN

// POST TEST
Route::resource('/post-test', 'PostTestController');
Route::post('/submit-post-test', [PostTestController::class, 'submitPostTest']);
Route::get('/post-test-result', [PostTestController::class, 'showResult']);
// END POST TEST

// HISTORY POST TEST
Route::resource('/user-post-test', 'UserPostController');
Route::get('/post-test-result/{id}', [UserPostController::class, 'showResult']);

// TESTIN GROUTE
Route::view('/tes', 'user_kuesioner_ending');