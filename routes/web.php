<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\MemberUserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffUserController;
use App\Http\Controllers\MemberRegistrationController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');//name buat ngubah nama route ke login
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');


// Route::group(['middleware' => ['auth']],function (){
//     Route::group(['middleware' => ['CheckUserLogin:staff']], function(){
//         Route::resource('dashboard', dashboard::class);
//     });
// });

// Staff = penjaga,admin,dll

// Khusus staff dan admin
Route::resource('/table/members', MemberController::class)->middleware('staff'); 
Route::resource('/table/books', BookController::class)->middleware('staff');
Route::resource('/table/stocks', StockController::class)->middleware('staff');
Route::resource('/table/schools', SchoolController::class)->middleware('staff');
Route::resource('/table/shifts', ShiftController::class)->middleware('staff');

Route::resource('/table/member-users', MemberUserController::class)->middleware('staff');

Route::resource('/transaction/member-registrations', MemberRegistrationController::class)->middleware('staff');
// 

//Khusus Admin
Route::resource('/table/staff-users', StaffUserController::class)->middleware('admin');
Route::resource('/table/staffs', StaffController::class)->middleware('admin');
//