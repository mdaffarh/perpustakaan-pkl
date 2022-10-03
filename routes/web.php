<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffUserController;
use App\Http\Controllers\MemberUserController;
use App\Http\Controllers\BookDonationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StaffRegistrationController;
use App\Http\Controllers\MemberRegistrationController;
use App\Models\BookDonation;

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

// Dashboard
    Route::resource('/dashboard', DashboardController::class)->middleware('auth'); 

// Profile
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile','index')->middleware('auth');
        Route::get('/profile/edit','edit')->middleware('auth');
        Route::post('/profile/update','update')->middleware('auth');
        Route::post('/profile/delete','delete')->middleware('auth');
    });

// Login
    Route::controller(LoginController::class)->group(function(){
        Route::get('/login','index')->name('login')->middleware('guest');
        Route::get('/register','register')->name('register')->middleware('guest');
        Route::get('/donation','donation')->name('donation')->middleware('guest');
        Route::post('/login','authenticate');
        Route::post('/logout','logout');
    });

// Pendaftaran
    Route::controller(MemberRegistrationController::class)->group(function(){
        Route::get('/transaction/member-registrations/index','index')->middleware('staff');
        Route::post('/transaction/member-registrations/tolak/{id}','tolak')->middleware('staff');
        Route::post('/transaction/member-registrations/approved/{id}','approved')->middleware('staff');
        Route::post('/transaction/member-registrations/directStore','directStore')->middleware('staff');
        Route::post('/transaction/member-registrations/store','store')->middleware('guest');
    });

    Route::controller(StaffRegistrationController::class)->group(function(){
        Route::get('/transaction/staff-registrations/index','index')->middleware('admin');
        Route::post('/transaction/staff-registrations/tolak/{id}','tolak')->middleware('admin');
        Route::post('/transaction/staff-registrations/approved/{id}','approved')->middleware('admin');
        Route::post('/transaction/staff-registrations/directStore','directStore')->middleware('admin');
        Route::post('/transaction/staff-registrations/store','store')->middleware('guest');
        Route::post('/transaction/staff-registrations/stores','stores')->middleware('admin');
    });
    //


// Staff = penjaga,admin,dll

    // Khusus staff dan admin
    Route::resource('/table/members', MemberController::class)->middleware('staff'); 
    Route::resource('/table/books', BookController::class)->middleware('staff');
    Route::resource('/table/stocks', StockController::class)->middleware('staff');
    Route::resource('/table/shifts', ShiftController::class)->middleware('staff');
    Route::resource('/users/member-users', MemberUserController::class)->middleware('staff');
    
    Route::resource('/transaction/fines', FineController::class)->middleware('staff');
    // 

    //Khusus Admin
    Route::resource('/users/staff-users', StaffUserController::class)->middleware('admin');
    Route::resource('/table/staffs', StaffController::class)->middleware('admin');
    Route::resource('/data/schools', SchoolController::class)->middleware('admin');
    //

// Semua user ('auth')
    //Sumbangan Buku
    Route::resource('/transaction/book-donations', BookDonationController::class)->middleware('auth');
    Route::controller(BookDonationController::class)->group(function(){
        Route::post('/transaction/book-donations/approved','approved')->middleware('auth');
        Route::post('/transaction/book-donations/taken','status')->middleware('auth');
        Route::post('/transaction/book-donations/addBook', 'addBook')->middleware('auth');  
        Route::post('/transaction/book-donations/reject/{id}', 'reject')->middleware('auth');
        Route::post('/transaction/book-donations/cancel', 'cancel')->middleware('auth'); 
    });

    Route::get('ajax-autocomplete-search', [BookDonationController::class,'search']);
    

    //Peminjaman
    Route::resource('/transaction/borrows', BorrowController::class)->middleware('auth');
    Route::controller(BorrowController::class)->group(function(){
        Route::post('/transaction/borrows/reject/{id}','reject')->middleware('auth');
        Route::post('/transaction/borrows/approve/{id}','approve')->middleware('auth');
        Route::post('/transaction/pengambilan_buku/{id}','getBook')->middleware('auth');
        Route::post('/transaction/returnBook/{id}','returnBook')->middleware('auth');
        Route::post('/transaction/return/detail/{id}','DetailPengembalian')->middleware('auth');
        
        Route::post('/transaction/borrows/directBorrow','directBorrow')->middleware('staff');
        Route::post('/transaction/borrows/updateBorrow/{id}','updateBorrow')->middleware('staff');
        Route::post('/transaction/borrows/deleteBorrow/{id}','deleteBorrow')->middleware('staff');
    });
    //

    // Pengembalian
    Route::resource('/transaction/return', ReturnController::class)->middleware('auth');
    Route::controller(ReturnController::class)->group(function(){
        Route::post('/transaction/return/back/{id}','store')->middleware('auth');
        // Route::post('/transaction/borrows/reject/{id}','reject')->middleware('auth');
        // Route::post('/transaction/borrows/approve/{id}','approve')->middleware('auth');
    });
    //

    // Wishlist
    Route::resource('/transaction/wishlist', WishlistController::class)->middleware('auth');
    Route::controller(WishlistController::class)->group(function(){
        Route::post('/transaction/wishlist/checkout', 'checkout')->middleware('auth');
        Route::delete('/wishlist/delete/{id}', 'delete')->middleware('auth');
        Route::post('/transaction/wishlist/add', 'store')->middleware('auth');
    });

    //Notifikasi
    Route::resource('notification', NotificationController::class)->middleware('auth');
    Route::controller(NotificationController::class)->group(function(){
        Route::post('/notification/viewed','viewed')->name('viewed')->middleware('auth');
        Route::post('/notification/viewedAll','viewedAll')->name('viewedAll')->middleware('auth');
        Route::post('/notification/deleteAll/{id}','deleteAll')->name('deleteAll')->middleware('auth');
        Route::post('/notification/deleteAllStaff/{id}','deleteAllStaff')->name('deleteAllStaff')->middleware('staff');
        Route::post('/notification/viewedAllStaff','viewedAllStaff')->name('viewedAllStaff')->middleware('staff');
    });

Route::controller(ReportController::class)->group(function(){
    Route::get('/report/fine','fine')->middleware('admin');
});