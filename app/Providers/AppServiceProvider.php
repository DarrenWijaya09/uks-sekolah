<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap(); // Jika menggunakan Bootstrap
        // atau
        Paginator::defaultView('vendor.pagination.tailwind'); // Jika menggunakan Tailwind

        Route::aliasMiddleware('role', CheckRole::class);
    }
}
