<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StaffUserController;
use App\Http\Controllers\MemberUserController;
use App\Http\Controllers\StaffRegistrationController;
use App\Http\Controllers\MemberRegistrationController;
use App\Http\Controllers\BookDonationController;
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
    return redirect('/dashboard');
})->middleware('auth');


Route::controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login')->middleware('guest');
    Route::get('/register','register')->name('register')->middleware('guest');
    Route::post('/login','authenticate');
    Route::post('/logout','logout');
});


Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');


// Staff = penjaga,admin,dll

// Khusus staff dan admin
Route::resource('/transaction/member-registrations', MemberRegistrationController::class)->middleware('staff');
Route::resource('/transaction/book-donations', BookDonationController::class)->middleware('staff');

Route::resource('/table/members', MemberController::class)->middleware('staff'); 
Route::resource('/table/books', BookController::class)->middleware('staff');
Route::resource('/table/stocks', StockController::class)->middleware('staff');
Route::resource('/table/shifts', ShiftController::class)->middleware('staff');
Route::resource('/table/member-users', MemberUserController::class)->middleware('staff');
// 

//Khusus Admin
Route::resource('/table/staff-users', StaffUserController::class)->middleware('admin');
Route::resource('/table/staffs', StaffController::class)->middleware('admin');
Route::resource('/table/schools', SchoolController::class)->middleware('admin');

Route::resource('/transaction/staff-registrations', StaffRegistrationController::class)->middleware('admin');