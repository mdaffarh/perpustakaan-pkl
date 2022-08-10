<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
<<<<<<< HEAD
use App\Http\Controllers\tb_schoolController;
=======
use App\Http\Controllers\SchoolController;

>>>>>>> 52aee58ed61a6d75d8b6a197618701f48a3f9102

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
    return view('login.index');
});

// Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login')->middleware('guest');
    Route::post('login/proses', 'proses');
    Route::post('logout', 'logout');
});

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');


// Route::group(['middleware' => ['auth']],function (){
//     Route::group(['middleware' => ['CheckUserLogin:staff']], function(){
//         Route::resource('dashboard', dashboard::class);
//     });
// });
Route::resource('/dashboard/books', BookController::class)->middleware('auth');

<<<<<<< HEAD
Route::resource('tb_school',tb_schoolController::class)->middleware('auth');
=======
Route::resource('/books', BookController::class)->middleware('auth');

Route::resource('/schools', SchoolController::class)->middleware('auth');
>>>>>>> 52aee58ed61a6d75d8b6a197618701f48a3f9102
