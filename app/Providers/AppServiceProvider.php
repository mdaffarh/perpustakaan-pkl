<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function(User $user){
            return $user->role === 'admin';
        });
        Gate::define('staff', function(User $user){
            return $user->staff_id;
        });
        Gate::define('member', function(User $user){
            return $user->member_id;
        });

        view()->composer('layout.right', function ($view) {
            view()->share([
                'notifications' => Notification::where('user_id',auth()->user()->id)->latest()->get(),
                'notiCount'=> Notification::whereNull('viewed')->where('user_id',auth()->user()->id)->count(),
                
                'notiStaff' => Notification::whereNull('user_id')->latest()->get(),
                'notiStaffCount' => Notification::whereNull('viewed')->whereNull('user_id')->count()
            ]);
        });
    }
}