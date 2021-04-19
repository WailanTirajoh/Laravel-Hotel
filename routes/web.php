<?php

use App\Events\TestEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationsController;
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
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    // Upload Room Image
    Route::post('/room/{room}/image/upload', [ImageController::class, 'create'])->name('image.create');
    Route::delete('/image/{image}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::name('transaction.reservation.')->group(function () {
        Route::get('/createIdentity', [TransactionRoomReservationController::class, 'createIdentity'])->name('createIdentity');
        Route::get('/pickFromCustomer', [TransactionRoomReservationController::class, 'pickFromCustomer'])->name('pickFromCustomer');
        Route::post('/storeCustomer', [TransactionRoomReservationController::class, 'storeCustomer'])->name('storeCustomer');
        Route::get('/{customer}/viewCountPerson', [TransactionRoomReservationController::class, 'viewCountPerson'])->name('viewCountPerson');
        Route::get('/{customer}/chooseRoom', [TransactionRoomReservationController::class, 'chooseRoom'])->name('chooseRoom');
        Route::get('/{customer}/{room}/{from}/{to}/confirmation', [TransactionRoomReservationController::class, 'confirmation'])->name('confirmation');
        Route::post('/{customer}/{room}/payDownPayment', [TransactionRoomReservationController::class, 'payDownPayment'])->name('payDownPayment');
    });

    // Resource
    Route::resource('customer', CustomerController::class);
    Route::resource('type', TypeController::class);
    Route::resource('room', RoomController::class);
    Route::resource('roomstatus', RoomStatusController::class);
    Route::resource('transaction', TransactionController::class);

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/{payment}/invoice', [PaymentController::class, 'invoice'])->name('payment.invoice');

    Route::get('/transaction/{transaction}/payment/create', [PaymentController::class, 'create'])->name('transaction.payment.create');
    Route::post('/transaction/{transaction}/payment/store', [PaymentController::class, 'store'])->name('transaction.payment.store');

    // Chart pada dashboard
    Route::get('/get-dialy-guest-chart-data', [ChartController::class, 'dialyGuestPerMonth']);
    Route::get('/get-dialy-guest-chart-data/{year}/{month}/{day}', [ChartController::class, 'dialyGuest'])->name('chart.dialyGuest');
});
Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Customer']], function () {
    Route::resource('user', UserController::class)->only([
        'show'
    ]);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Route::view('/', 'home')->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/mark-all-as-read',[NotificationsController::class,'markAllAsRead'])->name('notification.markAllAsRead');
});

Route::get('/sendEvent', [EventController::class,'sendEvent']);
Route::get('/seeEvent', [EventController::class,'seeEvent']);

Route::get('/listen', function(){
    return view('event.listen');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin']);

// Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
