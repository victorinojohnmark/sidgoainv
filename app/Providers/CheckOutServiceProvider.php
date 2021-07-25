<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\CheckOutObserver;
use App\Models\CheckOut;

class CheckOutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        CheckOut::observe(CheckOutObserver::class);
    }
}
