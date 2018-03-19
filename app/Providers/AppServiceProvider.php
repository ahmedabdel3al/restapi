<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserEmailUpdated;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Product::updated(function ($product) {
            if ($product->quantity == 0 && $product->isAvilable()) {
                $product->status = Product::UNAVILABLE;
                $product->save();
            }

        });
        User::created(function (User $user){
          retry(5,
                function ()use($user) {mail::to($user)->send(new UserCreated($user));}
                ,100);
        });
        User::updated(function (User $user){
            if ($user->isDirty('email')){
                retry(5,
                    function ()use($user) {mail::to($user)->send(new UserEmailUpdated($user));}
                    ,100);
            }

        });
    }


    public function register()
    {
        //
    }
}
