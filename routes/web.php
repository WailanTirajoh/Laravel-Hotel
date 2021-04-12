<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomReservationConteroller;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
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


Route::group(['middleware' => ['auth', 'checkRole:Super']], function () {
    Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    // Search
    Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');
    Route::get('/type/search', [TypeController::class, 'search'])->name('type.search');
    Route::get('/room/search', [RoomController::class, 'search'])->name('room.search');
    Route::get('/transaction/search', [TransactionController::class, 'search'])->name('transaction.search');
    Route::get('/payment/search', [PaymentController::class, 'search'])->name('payment.search');

    // Resource
    Route::resource('customer', CustomerController::class);
    Route::resource('type', TypeController::class);
    Route::resource('room', RoomController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('payment', PaymentController::class);

    // Room Reservation
    Route::get('/reservation',[RoomReservationConteroller::class,'index'])->name('reservation.index');
});
Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Customer']], function () {
    Route::resource('user', UserController::class)->only([
        'show'
    ]);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::view('/', 'home')->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::view('/login', 'auth.login')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin']);
