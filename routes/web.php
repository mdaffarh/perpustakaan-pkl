<?php

use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
    Route::get('login/dashboard', function(){
        return view('login.dashboard');
    });
});

Route::group(['middleware' => ['auth']],function (){
    Route::group(['middleware' => ['CheckUserLogin:staff']], function(){
        Route::resource('dashboard', dashboard::class);
    });
});


