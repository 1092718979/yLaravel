<?php

namespace App\Providers;

use App\Topic;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *  每个页面启动都会经过的地方
     * @return void
     */
    public function boot()
    {
        //设置string最大长度
        Schema::defaultStringLength(191);
        //在打开的每个网页中，对这个模板进行预加载
        View::composer('layout.sidebar',function ($view){
            $topics = Topic::all();

            $view->with('topics',$topics);
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
