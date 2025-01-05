<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Schema::defaultStringLength(191);

        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        View::composer('*', function ($view) {
            $view->with('contactsCount', ContactMessage::count());
        });

        // Share admin's name and profile picture with all views
        View::composer('*', function ($view) {
            $admin = Auth::guard('admin')->user();

            $view->with('adminName', $admin->name ?? null);
            $view->with('adminProfilePicture', $admin->profile_picture ?? 'default.png');
        });

    }
}
