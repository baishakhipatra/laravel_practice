<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Chat;

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
    public function boot()
    {
        View::composer('*', function($view){
            $adminId = 9;

            $userMessageCount = Chat::where('receiver_id', $adminId)
            ->where('sender','user')
            ->distinct('user_id')
            ->count('user_id');

            $messages = Chat::where('receiver_id', $adminId)
            ->where('sender', 'user')
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

            $view->with(compact('userMessageCount','messages'));
        });
    }
}
