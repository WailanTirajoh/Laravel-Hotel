<?php

namespace App\Providers;

use App\Repositories\CustomerRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interface\CustomerRepositoryInterface;
use App\Repositories\Interface\ImageRepositoryInterface;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\RoomRepositoryInterface;
use App\Repositories\Interface\RoomStatusRepositoryInterface;
use App\Repositories\PaymentRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use App\Repositories\RoomStatusRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(RoomStatusRepositoryInterface::class, RoomStatusRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
