<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProfilDesa;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('public.*', function ($view) {
            $view->with('profil', ProfilDesa::first());
        });

        View::composer('auth.login', function ($view) {
            $view->with('profil', ProfilDesa::first());
        });
    }
}