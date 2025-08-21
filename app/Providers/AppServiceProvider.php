<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
   public function register(): void {
    $this->app->bind(
        \App\Repositories\LoanDetailsRepositoryInterface::class,
        \App\Repositories\EloquentLoanDetailsRepository::class
    );
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
