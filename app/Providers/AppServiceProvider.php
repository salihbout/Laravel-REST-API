<?php

namespace App\Providers;

use App\User;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
//use Illuminate\Http\Resources\Json\JsonResource;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
       // Resource::withoutWrapping();

       User::created(function($user){
           Mail::to($user)->send(new UserCreated($user));
       });
    }





    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
