<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/8/5
 * Time: 18:00
 */

Route::group(['prefix' => 'admin'],function (){
    //登陆展示，登陆行为，登出行为
    Route::get('/login','\App\Admin\Controller\LoginController@index');
    Route::post('/login','\App\Admin\Controller\LoginController@login');
    Route::get('/logout','\App\Admin\Controller\LoginController@logout');

    //首页
    Route::get('/home','\App\Admin\Controller\HomeController@index');

});
