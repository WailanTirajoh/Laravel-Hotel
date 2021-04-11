<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
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
    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::view('/user/add', 'user.add')->name('user.add');
    Route::any('/user/search', [UserController::class, 'search'])->name('user.search');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/edit/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    // Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::view('/customer/add', 'customer.add')->name('customer.add');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/edit/{customer}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/customer/destroy/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    // Type
    Route::get('/type', [TypeController::class, 'index'])->name('type');
    Route::view('/type/add', 'type.add')->name('type.add');
    Route::post('/type/store', [TypeController::class, 'store'])->name('type.store');
    Route::get('/type/edit/{type}', [TypeController::class, 'edit'])->name('type.edit');
    Route::post('/type/edit/{type}/update', [TypeController::class, 'update'])->name('type.update');
    Route::get('/type/destroy/{type}', [TypeController::class, 'destroy'])->name('type.destroy');

    // Room
    Route::get('/room', [RoomController::class, 'index'])->name('room');
    Route::get('/room/add', [RoomController::class, 'add'])->name('room.add');
    Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
    Route::get('/room/edit/{room}', [RoomController::class, 'edit'])->name('room.edit');
    Route::post('/room/edit/{room}/update', [RoomController::class, 'update'])->name('room.update');
    Route::get('/room/destroy/{room}', [RoomController::class, 'destroy'])->name('room.destroy');

    // transaction
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/transaction/add', [TransactionController::class, 'add'])->name('transaction.add');
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/edit/{transaction}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::post('/transaction/edit/{transaction}/update', [TransactionController::class, 'update'])->name('transaction.update');
    Route::get('/transaction/destroy/{transaction}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

    // Payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('/payment/add', [PaymentController::class, 'add'])->name('payment.add');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/edit/{payment}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::post('/payment/edit/{payment}/update', [PaymentController::class, 'update'])->name('payment.update');
    Route::get('/payment/destroy/{payment}', [PaymentController::class, 'destroy'])->name('payment.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Home
    Route::view('/', 'home')->name('home');
    // Auth
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::view('/login', 'auth.login')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin']);
