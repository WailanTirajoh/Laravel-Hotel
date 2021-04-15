<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransactionRoomReservationController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\TransactionController;
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
    // Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
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
    Route::resource('roomstatus', RoomStatusController::class);

    // Upload Room Image
    Route::post('/room/{room}/image/upload', [RoomController::class, 'imageUpload'])->name('room.imageUpload');


    Route::post('/image/{image}/destroy', [ImageController::class, 'destroy'])->name('image.destroy');

    // Room Reservation
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/reservation/createIdentity', [TransactionRoomReservationController::class, 'createIdentity'])->name('reservation.createIdentity');
    Route::get('/transaction/reservation/pickFromCustomer', [TransactionRoomReservationController::class, 'pickFromCustomer'])->name('reservation.pickFromCustomer');
    Route::get('/transaction/reservation/pickFromCustomer/search', [TransactionRoomReservationController::class, 'usersearch'])->name('reservation.usersearch');
    Route::post('/transaction/reservation/storeCustomer', [TransactionRoomReservationController::class, 'storeCustomer'])->name('reservation.storeCustomer');
    Route::get('/transaction/reservation/{customer}/countPerson', [TransactionRoomReservationController::class, 'countPerson'])->name('reservation.countPerson');
    Route::get('/transaction/reservation/{customer}/chooseRoom', [TransactionRoomReservationController::class, 'chooseRoom'])->name('reservation.chooseRoom');
    Route::get('/transaction/reservation/{customer}/{room}/{from}/{to}/confirmation', [TransactionRoomReservationController::class, 'confirmation'])->name('reservation.confirmation');
    Route::post('/transaction/reservation/{customer}/{room}/payDownPayment', [TransactionRoomReservationController::class, 'payDownPayment'])->name('reservation.payDownPayment');

    Route::get('/payment/create/{transaction}/', [PaymentController::class, 'create'])->name('payment.create');


    // Chart pada dashboard
    Route::get('/get-dialy-guest-chart-data',[ChartController::class,'dialyGuestPerMonth']);
    Route::get('/get-dialy-guest-chart-data/{year}/{month}/{day}',[ChartController::class,'dialyGuest']);
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
