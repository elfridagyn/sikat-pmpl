<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\AssetHistory;

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
    View::composer('*', function ($view) {

        $notifications = AssetHistory::with([
                'user',
                'asset'
            ])
            ->latest()
            ->take(5)
            ->get();

        $view->with(
            'notifications',
            $notifications
        );
    });
}
}
