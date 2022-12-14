<?php

use App\Models\BookDonation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\FPDFController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MajorController;
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
use App\Http\Controllers\InformationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StaffRegistrationController;
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
        return redirect('/dashboard');
    })->middleware('auth');

// Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth'); 

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
    Route::resource('/table/shifts', ShiftController::class)->middleware('staff');
    Route::resource('/users/member-users', MemberUserController::class)->middleware('staff');
    Route::resource('/transaction/fines', FineController::class)->middleware('staff');

    Route::resource('/table/stocks', StockController::class)->middleware('staff');
    Route::controller(StockController::class)->group(function(){
        Route::post('/table/stocks/plus','plus')->middleware('staff');
        Route::post('/table/stocks/minus','minus')->middleware('staff');
    });
    // 

    //Khusus Admin
    Route::resource('/users/staff-users', StaffUserController::class)->middleware('admin');
    Route::resource('/table/staffs', StaffController::class)->middleware('admin');
    Route::resource('/table/schools', SchoolController::class)->middleware('admin');
    Route::resource('/table/majors', MajorController::class)->middleware('admin');
    //

// Semua user ('auth')
    //Sumbangan Buku
    Route::resource('/transaction/book-donations', DonationController::class)->middleware('auth');
    Route::controller(DonationController::class)->group(function(){
        Route::post('/transaction/book-donations/create','create')->middleware('auth');
        Route::get('/transaction/book-donations/edit/{id}','edit')->middleware('auth');
        Route::get('/transaction/book-donations/approved/{id}','setuju')->middleware('auth');
        Route::get('/transaction/book-donations/reject/{id}','tolak')->middleware('auth');
        Route::get('/transaction/book-donations/handover/{id}','serahTerima')->middleware('auth');
        Route::get('/transaction/book-donations/delete/{id}','hapus')->middleware('auth');
        Route::get('/transaction/book-donations/cancel/{id}','batalkan')->middleware('auth');
    });

    

    //Peminjaman
    Route::resource('/transaction/borrows', BorrowController::class)->middleware('auth');
    Route::controller(BorrowController::class)->group(function(){
        Route::post('/transaction/borrows/reject/{id}','reject')->middleware('auth');
        Route::post('/transaction/borrows/approve/{id}','approve')->middleware('auth');
        Route::post('/transaction/pengambilan_buku/{id}','getBook')->middleware('auth');
        
        Route::post('/transaction/borrows/directBorrow','directBorrow')->middleware('staff');
        Route::post('/transaction/borrows/updateBorrow/{id}','updateBorrow')->middleware('staff');
        Route::post('/transaction/borrows/deleteBorrow/{id}','deleteBorrow')->middleware('staff');
    });
    //

    // Pengembalian
    Route::resource('/transaction/returns', ReturnController::class)->middleware('auth');
    Route::controller(ReturnController::class)->group(function(){
        Route::post('/transaction/returnBook/{id}','returnBook')->middleware('auth');
        Route::post('/transaction/returns/detail/{id}','DetailPengembalian')->middleware('auth');
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

    // Informasi
    Route::controller(InformationController::class)->group(function(){
        Route::get('/information/borrows','borrow')->middleware('staff');
        Route::get('/information/returns','return')->middleware('staff');
        Route::get('/information/books','book')->middleware('staff');
        Route::get('/information/book-donations','bookDonation')->middleware('staff');      
        Route::get('/information/fines','fine')->middleware('staff');
        Route::get('/information/member-registrations','memberRegistration')->middleware('staff');
        Route::get('/information/staff-registrations','staffRegistration')->middleware('staff');
    });

    // Halaman Report
Route::controller(ReportController::class)->group(function(){
    Route::post('/report/borrows','borrow')->middleware('admin');
    Route::get('/report/borrows/set','borrowSet')->middleware('admin');

    Route::post('/report/returns','return')->middleware('admin');
    Route::get('/report/returns/set','returnSet')->middleware('admin');

    Route::post('/report/fines','fine')->middleware('admin');
    Route::get('/report/fines/set','fineSet')->middleware('admin');

    Route::post('/report/member-registrations','memberRegistration')->middleware('admin');
    Route::get('/report/member-registrations/set','memberRegistrationSet')->middleware('admin');

    Route::post('/report/staff-registrations','staffRegistration')->middleware('admin');
    Route::get('/report/staff-registrations/set','staffRegistrationSet')->middleware('admin');
    
    Route::post('/report/members','member')->middleware('admin');
    Route::get('/report/members/set','memberSet')->middleware('admin');

    Route::post('/report/staffs','staff')->middleware('admin');
    Route::get('/report/staffs/set','staffSet')->middleware('admin');

    Route::post('/report/books','book')->middleware('admin');
    Route::get('/report/books/set','bookSet')->middleware('admin');

    Route::post('/report/borrow-items','borrowItem')->middleware('admin');
    Route::get('/report/borrow-items/set','borrowItemSet')->middleware('admin');
    
    Route::post('/report/borrow-ranks','borrowRank')->middleware('admin');
    Route::get('/report/borrow-ranks/set','borrowRankSet')->middleware('admin');
    
});

// Pdf Report
Route::controller(FPDFController::class)->group(function(){
    Route::get('/borrow-report','borrowReport')->middleware('admin');
    Route::get('/return-report','returnReport')->middleware('admin');
    Route::get('/fine-report','fineReport')->middleware('admin');
    Route::get('/member-registration-report','memberRegistrationReport')->middleware('admin');
    Route::get('/staff-registration-report','staffRegistrationReport')->middleware('admin');
    Route::get('/member-report','memberReport')->middleware('admin');
    Route::get('/staff-report','staffReport')->middleware('admin');
    Route::get('/book-report','bookReport')->middleware('admin');
    Route::get('/borrow-item-report','borrowItemReport')->middleware('admin');
    Route::get('/borrow-rank-report','borrowRankReport')->middleware('admin');
});