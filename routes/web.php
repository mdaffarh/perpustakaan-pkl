<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StaffController;

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

Route::resource('/table/schools', SchoolController::class)->middleware('auth');
Route::resource('/table/books', BookController::class)->middleware('auth');
Route::resource('/table/members', MemberController::class)->middleware('auth');
Route::resource('/table/stocks', StockController::class)->middleware('auth');
Route::resource('/table/staffs', StaffController::class)->middleware('auth');